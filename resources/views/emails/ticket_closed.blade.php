@component('mail::message')
    # Ticket Closed

    The ticket with the following details has been closed:

    **Ticket Number: {{ $ticket->ticket_no }}
    **Title: {{ $ticket->title }}
    **Description: {{ $ticket->description }}
    **Comment from Agent: {{ $ticket->comment }}

    Thanks,
@endcomponent
