@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        @foreach ($cardsData as $card)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div
                        class="card-header bg-{{ $card['color'] }} text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="{{ $card['icon'] }} mr-2"></i> {{ $card['title'] }}</h5>
                        <span class="badge badge-light">{{ $card['total'] }}</span>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="active-numbers display-6 text-{{ $card['color'] }}">{{ $card['active'] }}</h2>
                        <p class="inactive-numbers text-muted">Inactive: {{ $card['inactive'] }}</p>
                        <a href="{{ $card['link'] }}" class="btn btn-{{ $card['color'] }} btn-sm">Manage
                            {{ $card['title'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastEl = document.getElementById('successToast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
@endsection
