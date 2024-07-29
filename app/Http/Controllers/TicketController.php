<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('auth.ticket', compact('tickets'));
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
        Ticket::create($request->all());
        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $concert = Concert::findOrFail($id);
        $ticketCount = $concert['tickets']->count();
        return view('tickets.show', compact('concert', 'ticketCount'));
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
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('tickets.index');
    }
}
