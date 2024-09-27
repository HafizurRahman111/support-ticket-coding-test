@extends('layouts.layout')

@section('title', 'Tickets')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">

    <style>
        .btn-sm {
            padding: 0.25rem 0.5rem;
        }

        .dt-buttons {
            float: right;
            margin-bottom: 1rem;
        }

        .table-responsive {
            overflow: auto;
        }

        .wrap-text {
            white-space: normal;
            word-wrap: break-word;
        }
    </style>
@endsection

@section('content')
    @php
        $routeName = 'tickets.create';
        $showCreateButton = true;
    @endphp

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="ticketsTable" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th>Ticket No.</th>
                                        @if ($currentUserRole == 'admin')
                                            <th>User</th>
                                        @endif
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Closed</th>
                                        <th>Description</th>
                                        <th>Comment</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        @if ($currentUserRole == 'admin')
                                            <th data-priority="2">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->ticket_no }}</td>

                                            @if ($currentUserRole == 'admin')
                                                <td class="text small">{{ $ticket->user->name }}</td>
                                            @endif

                                            <td class="text small">{{ $ticket->title }}</td>
                                            <td>
                                                <span class="badge {{ $ticket->status == 2 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $ticket->status == 2 ? 'Closed' : 'Open' }}
                                                </span>
                                                @if ($ticket->status == 1 && $currentUserRole == 'admin')
                                                    <form action="{{ route('tickets.close', $ticket->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            onclick="return confirm('Are you sure you want to close this ticket?');">Close</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td class="text-muted small">
                                                {{ $ticket->closed_at ? \Carbon\Carbon::parse($ticket->closed_at)->format('d-m-y h:i A') : 'N/A' }}
                                            </td>
                                            <td>
                                                <span class="d-inline-block text-truncate small" style="max-width: 150px;">
                                                    {{ Str::limit($ticket->description, 20, '...') }}
                                                </span>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#descriptionModal{{ $ticket->id }}">
                                                    View
                                                </a>
                                            </td>
                                            <td>{!! nl2br(e(wordwrap($ticket->comment, 10))) !!}</td>
                                            <td class="text-muted small">
                                                {{ $ticket->created_at ? \Carbon\Carbon::parse($ticket->created_at)->format('d-m-y h:i A') : 'N/A' }}
                                            </td>
                                            <td class="text-muted small">
                                                {{ $ticket->updated_at ? \Carbon\Carbon::parse($ticket->updated_at)->format('d-m-y h:i A') : 'N/A' }}
                                            </td>

                                            @if ($currentUserRole == 'admin')
                                                <td>
                                                    <a href="{{ route('tickets.edit', $ticket->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('tickets.destroy', $ticket->id) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif

                                        </tr>

                                        <!-- Modal for Full Description -->
                                        <div class="modal fade" id="descriptionModal{{ $ticket->id }}" tabindex="-1"
                                            aria-labelledby="descriptionModalLabel{{ $ticket->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="descriptionModalLabel{{ $ticket->id }}">Ticket
                                                            Description [{{ $ticket->ticket_no }} - {{ $ticket->title }}]
                                                        </h5>

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        {{ $ticket->description }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

    <script>
        var userRole = "{{ auth()->user()->role->slug }}";
        console.log(userRole);

        $(document).ready(function() {
            let columnDefs;

            if (userRole == 'admin') {
                columnDefs = [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 3,
                        targets: -3
                    },
                    {
                        responsivePriority: 2,
                        targets: -1
                    }
                ];
            } else if (userRole == 'customer') {
                columnDefs = [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 3,
                        targets: 7
                    },
                    {
                        responsivePriority: 2,
                        targets: -1
                    }
                ];
            } else {
                columnDefs = [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 3,
                        targets: -3
                    },
                    {
                        responsivePriority: 2,
                        targets: -1
                    }
                ];
            }

            $('#ticketsTable').DataTable({
                responsive: true,
                ordering: true,
                searching: true,
                columnDefs: columnDefs,
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [
                    [5, 10, 20, 50],
                    [5, 10, 20, 50]
                ],
                pageLength: 5,
            });
        });
    </script>
@endsection
