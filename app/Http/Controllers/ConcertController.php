<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;

class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concerts = Concert::all();
        $concertCount = $concerts->count();
        return view('concerts.index', compact('concerts', 'concertCount'));
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
        $concert = new Concert();
        $concert->name = $request->name;
        $concert->description = $request->description;
        $concert->date = $request->date;
        $concert->venue = $request->venue;
        $concert->save();

        return redirect()->route('admin.concert')->with('success', 'Concert added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $concert = Concert::findOrFail($id);
        $ticketCount = $concert['tickets']->count();
        return view('concerts.show', compact('concert', 'ticketCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $concert = Concert::findOrFail($id);
        return view('admin.edit-concert', compact('concert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $concert = Concert::findOrFail($id);
        $concert->name = $request->name;
        $concert->description = $request->description;
        $concert->date = $request->date;
        $concert->venue = $request->venue;
        $concert->save();

        return redirect()->route('admin.concert')->with('success', 'Concert updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $concert = Concert::findOrFail($id);
        $concert->delete();
        return redirect()->route('admin.concert')->with('success', 'Concert deleted successfully');
    }
}
