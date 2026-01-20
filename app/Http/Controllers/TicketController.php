<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        $tickets = auth()->user()->tickets;

        return view('tickets-page', compact('tickets'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);
        Ticket::create($data);

        return redirect()->back()->with('success', 'You got a ticket , enjoy !');
    }
}
