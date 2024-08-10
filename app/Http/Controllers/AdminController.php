<?php

// app/Http/Auth/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Define the start and end dates
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfMonth();

        // Get the month from the request (default to the current month)
        $selectedMonth = $request->input('month', Carbon::now()->format('m'));

        // Get ticket sales data for the selected month
        $ticketSalesData = collect();
        $daysInMonth = Carbon::createFromFormat('m', $selectedMonth)->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::createFromFormat('Y-m-d', now()->year . '-' . $selectedMonth . '-' . $day);
            $count = Order::whereDate('created_at', $date)->count();

            $ticketSalesData->push([
                'count' => $count,
                'date' => $date->format('d/m'),
            ]);
        }

        // Prepare the data for the chart
        $data = $ticketSalesData->pluck('count')->toArray();
        $labels = $ticketSalesData->pluck('date')->toArray();

        $chartData = json_encode([
            'labels' => $labels,
            'data' => $data,
        ]);

        $recentTransactions = Order::orderBy('created_at', 'desc')
            ->take(5) // Get the latest 5 transactions
            ->get();

        $annualRevenue = Order::whereYear('created_at', date('Y'))
            ->sum('total_price');

        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        // Pass the data to the view
        return view('auth.dashboard', compact('chartData', 'selectedMonth', 'recentTransactions', 'annualRevenue', 'monthlyRevenue'));
    }


    public function concert()
    {
        $concerts = Concert::all();
        return view('auth.concert', compact('concerts'));
    }

    public function ticket()
    {
        $tickets = Ticket::all();
        return view('auth.ticket', compact('tickets'));
    }

    public function order()
    {
        $orderItems = OrderItem::all();
        return view('auth.orders.index', compact('orderItems'));
    }
}
