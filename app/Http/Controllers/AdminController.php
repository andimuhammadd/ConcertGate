<?php

// app/Http/Auth/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\OrderItem;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth.dashboard');
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
