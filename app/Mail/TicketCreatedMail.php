<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Ticket $ticket;  

    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket; 
    }

    /**
     * Build the message.
     */
    public function build(): self 
    {
        return $this->subject('New Ticket Created: # ' . $this->ticket->ticket_no . ' - ' . $this->ticket->title)
                    ->markdown('emails.ticket_created') 
                    ->with(['ticket' => $this->ticket]);
    }
}