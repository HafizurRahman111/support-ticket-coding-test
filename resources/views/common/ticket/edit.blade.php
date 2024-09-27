@extends('layouts.layout')

@section('title', 'Edit Ticket')

@section('styles')
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .card-body {
            padding: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <h5 class="mb-4">Current Ticket Details</h5>
                        <table class="table table-bordered mb-4">
                            <tbody>
                                <tr>
                                    <th>Ticket No.</th>
                                    <td>{{ $ticket->ticket_no }}</td>
                                    <th>User</th>
                                    <td>{{ $ticket->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $ticket->title }}</td>
                                    <th>Status</th>
                                    <td>{{ $ticket->status == 1 ? 'Open' : 'Closed' }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td colspan="3">{{ $ticket->description }}</td>
                                </tr>
                                <tr>
                                    <th>Comment</th>
                                    <td colspan="3">{{ $ticket->comment }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                    <th>Updated At</th>
                                    <td>{{ $ticket->updated_at ? $ticket->updated_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $ticket->title) }}" required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status<span
                                            class="text-danger">*</span></label>
                                    <br />
                                    <select name="status" id="status"
                                        class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="1" {{ $ticket->status == 1 ? 'selected' : '' }}>Open</option>
                                        <option value="2" {{ $ticket->status == 2 ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="description" id="description" rows="4"
                                        class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $ticket->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea name="comment" id="comment" rows="4" class="form-control @error('comment') is-invalid @enderror">{{ old('comment', $ticket->comment) }}</textarea>
                                    @error('comment')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="mt-3" style="position: relative;">
                                <button type="submit" class="btn btn-primary float-end">Update Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
