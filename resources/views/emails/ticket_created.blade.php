@component('mail::message')
    # New Ticket Created

    A new ticket has been created by **{{ $ticket->user->name }}**.

    **Ticket Number: {{ $ticket->ticket_no }}
    **Title: {{ $ticket->title }}
    **Description:
    {{ $ticket->description }}
@endcomponent
