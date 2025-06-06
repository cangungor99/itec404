@extends('layouts.app')
@section('title', 'Club Budget')
@section('content')
<main class="page-content">
    <div class="container py-4">
        <h3>{{ $club->name }} Budget</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Total Budget:</strong> {{ $club->budget->total_budget ?? 'Not Set' }}</p>
                <p><strong>Budget Left:</strong> {{ $club->budget->budget_left ?? 'Not Set' }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('manager.budget.update') }}">
            @csrf
            <div class="mb-3">
                <label for="total_budget" class="form-label">Update Total Budget</label>
                <input type="number" step="0.01" name="total_budget" id="total_budget"
                       class="form-control" value="{{ old('total_budget', $club->budget->total_budget ?? '') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Budget</button>
        </form>
    </div>
</main>
@endsection
