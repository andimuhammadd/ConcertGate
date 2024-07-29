<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;
use App\Mail\TicketMail;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('auth.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $concert = $ticket->concert;

        return view('order.create-order', compact('ticket', 'concert'));
    }

    public function checkout(Order $order, Request $request)
    {
        // Set Midtrans configuration
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Transaction data
        $transaction_details = [
            'order_id' => $order->id,
            'gross_amount' => $order->total_price,
        ];

        // Item data
        $item_details = [
            [
                'id' => 'item1',
                'price' => $order->total_price,
                'quantity' => 1,
                'name' => 'Concert Ticket'
            ],
        ];

        // Customer data
        $customer_details = [
            'first_name' => $order->firstname,
            'last_name' => $order->lastname,
            'email' => $order->email,
            'phone' => $order->phone,
        ];

        $callbacks = [
            'finish' => "https://b194-116-206-33-37.ngrok-free.app/api/midtrans-finish",
        ];

        // Create transaction parameters
        $params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
            'callbacks' => $callbacks,
        ];

        try {
            // Get payment URL from Midtrans
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            // Send confirmation email
            Mail::to($order->email)->send(new OrderConfirmationMail($order, $paymentUrl));

            // Redirect to payment page
            return redirect($paymentUrl);
        } catch (\Exception $e) {
            log::error('Error during checkout:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $ticketId)
    {
        // // Validate data
        // $request->validate([
        //     'email' => 'required|email',
        //     'firstname' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255',
        //     'phone' => 'required|string|max:20',
        // ]);

        $ticket = Ticket::findOrFail($ticketId);
        $concert = $ticket->concert;
        $order = null;

        DB::transaction(function () use ($request, $ticket, &$order) {
            // Create Order
            $order = Order::create([
                'email' => $request->input('email'),
                'firstname' => $request->input('first_name'),
                'lastname' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'total_price' => $ticket->price,
                'status' => 'pending',
            ]);

            // Create Order Item
            OrderItem::create([
                'order_id' => $order->id,
                'ticket_id' => $ticket->id,
                'quantity' => 1,
                'price' => $ticket->price,
            ]);
        });

        if ($order) {
            return $this->checkout($order, $request);
        } else {
            return response()->json(['error' => 'Order creation failed'], 500);
        }
    }

    protected function generateAndSendTicket(Order $order)
    {
        // Load view for the ticket
        $pdf = PDF::loadView('tickets.ticket', compact('order'));

        // Define file name and path
        $fileName = 'ticket_' . $order->id . '.pdf';
        $filePath = storage_path('app/public/' . $fileName);

        // Save the PDF to the storage
        $pdf->save($filePath);

        // Send the ticket via email
        Mail::to($order->email)->send(new TicketMail($order, $filePath));
    }

    public function callback(Request $request)
    {
        // Validasi data masuk
        $request->validate([
            'order_id' => 'required|string',
            'status_code' => 'required|string',
            'gross_amount' => 'required|numeric',
            'signature_key' => 'required|string',
            'transaction_status' => 'required|string',
        ]);

        // Ambil server key dari konfigurasi
        $serverKey = config('midtrans.server_key');

        // Buat hash yang benar
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Periksa apakah signature key yang diterima sama dengan hash yang dihasilkan
        if ($hashed === $request->signature_key) {
            // Periksa status transaksi
            if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
                // Cari order berdasarkan order_id
                $order = Order::find($request->order_id);

                if ($order) {
                    // Perbarui status order menjadi 'paid'
                    $order->update(['status' => 'paid']);

                    // Simpan informasi pembayaran ke tabel payments
                    $payment = new Payment();
                    $payment->order_id = $order->id;
                    $payment->amount = $request->gross_amount;
                    $payment->payment_method = $request->payment_type ?? 'unknown'; // Menyimpan metode pembayaran
                    $payment->payment_status = $request->transaction_status;
                    $payment->transaction_id = $request->transaction_id ?? null; // Menyimpan ID transaksi jika ada
                    $payment->save();
                    
                    // Generate and send ticket
                    $this->generateAndSendTicket($order);
                } else {
                    // Log jika order tidak ditemukan
                    Log::error('Order not found for order_id: ' . $request->order_id);
                }
            } elseif ($request->transaction_status === 'cancel' || $request->transaction_status === 'expire') {
                // Jika transaksi dibatalkan atau kedaluwarsa
                $order = Order::find($request->order_id);
                if ($order) {
                    $order->update(['status' => 'canceled']);
                }
            }
        } else {
            // Log jika hash tidak cocok
            Log::error('Signature key mismatch for order_id: ' . $request->order_id);
        }
    }


    public function invoice(Request $request)
    {
        // Retrieve the order ID from the request or session
        $orderId = $request->query('order_id');

        // Find the order by ID
        $order = Order::findOrFail($orderId);

        // Pass the order to the view
        return view('order.invoice', compact('order'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return view('auth.orders.show', compact('orderItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('admin.order')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('auth.orders')->with('success', 'Order deleted successfully');
    }
}
