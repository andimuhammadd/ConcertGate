<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\Concert;
use App\Exports\ConcertDetailExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data yang diperlukan
        $totalOrders = Order::count();
        $totalSales = Order::sum('total_price');
        $totalTicketsSold = OrderItem::sum('quantity');
        $concerts = Concert::with('tickets.orderItems')->get();
        $payments = Payment::all();

        return view('auth.report', compact('totalOrders', 'totalSales', 'totalTicketsSold', 'concerts', 'payments'));
    }

    public function export($id)
    {
        $concert = Concert::with('tickets.orderItems.order')->findOrFail($id);
        return Excel::download(new ConcertDetailExport($concert), 'concert-details.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $concert = Concert::with(['tickets.orderItems.order.payments'])->findOrFail($id);
        return view('auth.reportdetail', compact('concert'));
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
