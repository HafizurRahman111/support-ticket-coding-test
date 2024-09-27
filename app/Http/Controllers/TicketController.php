<?php

namespace App\Http\Controllers;

use App\Mail\TicketCreatedMail;
use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Mail\TicketClosed;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = auth()->user();
        $currentUserRole = auth()->user()->role->slug;

        if ($currentUserRole == "admin") {
            $tickets = Ticket::all();
        } else {
            $tickets = Ticket::where('user_id', $currentUser->id)->orderByDesc('id')->get();
        }

        return view('common.ticket.index', compact('tickets', 'currentUserRole'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentUserRole = auth()->user()->role->slug;
        $ticketOpenCheck = Ticket::where('user_id', auth()->user()->id)->where('status', 1)->count();

        // dd($currentUserRole);
        if ($currentUserRole == 'customer' && $ticketOpenCheck > 0) {
            return redirect()->route('tickets.index')->with('error', 'You already have an open ticket. Please waiting for resolve the existing ticket before creating a new one.');
        }

        return view(view: 'common.ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        $uniqueTicketNo = auth()->id() . now()->format('ymd') . random_int(10, 99);

        $ticket = Ticket::create([
            'ticket_no' => $uniqueTicketNo,
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 1,
            'agent_id' => 1,
        ]);

        try {
            $toAdminEmail = 'ticket@mail.com';
            Mail::to($toAdminEmail)->send(new TicketCreatedMail($ticket));

            return redirect()->route('tickets.index')->with('message', 'Ticket created successfully! Email sent to admin.');
        } catch (Exception $e) {
            \Log::error('Email failed to send: ' . $e->getMessage());

            return redirect()->route('tickets.index')->with('message', 'Ticket created successfully, but email failed to send.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('common.ticket.edit', compact('ticket'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'comment' => 'nullable|string|max:800',
            'status' => 'required|integer|in:1,2', 
        ]);

        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->update([
                'title' => $request->title,
                'description' => $request->description,
                'comment' => $request->comment,
                'status' => $request->status,
            ]);

            return redirect()->route('tickets.index')->with('message', 'Ticket updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the ticket.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */


    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        try {
            $ticket->delete();

            return redirect()->route('tickets.index')->with('message', 'Ticket deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the ticket.');
        }
    }


    public function ticketClose($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->status == 2) {
            return redirect()->back()->with('error', 'This ticket is already closed.');
        }

        $ticket->status = 2;
        $ticket->closed_at = now();
        $ticket->save();

        $toUserEmail = $ticket->user->email;
       // dd($toUserEmail);

        try {
            Mail::to($toUserEmail)->send(new TicketClosed($ticket));

            return redirect()->route('tickets.index')->with('message', 'Ticket closed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to close the ticket: ' . $e->getMessage());
        }
    }
}