<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'finish' => "https://92ef-45-126-185-170.ngrok-free.app/api/midtrans-finish",
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

            // Redirect to payment page
            return redirect($paymentUrl);
        } catch (\Exception $e) {
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
                'status' => 'unpaid',
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
        // dd($_POST);
    }

    public function callback(Request $request)
    {
        // Ambil server key dari konfigurasi
        $serverKey = config('midtrans.server_key');

        // Buat hash yang benar
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Periksa apakah signature key yang diterima sama dengan hash yang dihasilkan
        if ($hashed === $request->signature_key) {
            // Periksa status transaksi
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                // Cari order berdasarkan order_id
                $order = Order::find($request->order_id);
                // Perbarui status order menjadi 'paid'
                $order->update(['status' => 'paid']);
            }
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
