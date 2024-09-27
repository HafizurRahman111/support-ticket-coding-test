@extends('layouts.layout')

@section('title', 'Create Ticket')

@section('styles')

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('tickets.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                    placeholder="Enter ticket title" required>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description<span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" rows="4" maxlength="500"
                                    class="form-control @error('description') is-invalid @enderror" placeholder="Enter ticket description" required>{{ old('description') }}</textarea>
                                <small id="descriptionCounter" class="form-text text-muted">0/500 characters used</small>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create Ticket</button>
                            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var descriptionField = document.getElementById('description');
            var counter = document.getElementById('descriptionCounter');

            counter.textContent = descriptionField.value.length + "/500 characters used";

            descriptionField.addEventListener('input', function() {
                var currentLength = descriptionField.value.length;
                counter.textContent = currentLength + "/500 characters used";
            });
        });
    </script>
@endsection
