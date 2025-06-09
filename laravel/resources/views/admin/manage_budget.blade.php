@extends('layouts.app')

@section('title', 'Manage Budget')

@push('styles')
<style>
    .club-card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        transition: transform 0.3s ease;
        border-radius: 1rem;
    }

    .club-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    @media (max-width: 576px) {
        .club-card h5 {
            font-size: 1rem;
        }

        .club-card p {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Budget</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse($clubs as $club)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="club-card shadow-sm p-4 rounded-4 animate__animated animate__fadeInUp">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('storage/' . $club->photo) }}" alt="Club Logo" class="me-3 rounded-circle border border-2" width="60" height="60">
                    <div>
                        <h5 class="mb-0">
                            <i class="bi bi-people-fill me-1 text-primary"></i> {{ $club->name }}
                        </h5>
                    </div>
                </div>

                @if($club->budget)
                    <p class="mb-1">
                        <i class="bi bi-cash-coin text-success me-1"></i>
                        <strong>Total Budget:</strong> ${{ number_format($club->budget->total_budget, 2) }}
                    </p>
                    <p class="mb-3">
                        <i class="bi bi-wallet2 text-warning me-1"></i>
                        <strong>Budget Left:</strong> ${{ number_format($club->budget->budget_left, 2) }}
                    </p>
                @else
                    <p class="text-muted mb-3">No budget assigned yet.</p>
                @endif

                <div class="text-end">
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#budgetModal{{ $club->clubID }}">
                        <i class="bi bi-gear me-1"></i> Manage Budget
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="budgetModal{{ $club->clubID }}" tabindex="-1" aria-labelledby="budgetModalLabel{{ $club->clubID }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.budgets.update', $club->clubID) }}" method="POST" class="modal-content">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="budgetModalLabel{{ $club->clubID }}">Manage Budget - {{ $club->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="total_budget{{ $club->clubID }}" class="form-label">Total Budget (₺)</label>
                            <input type="number" step="0.01" class="form-control" id="total_budget{{ $club->clubID }}" name="total_budget" value="{{ optional($club->budget)->total_budget ?? 0 }}">
                        </div>
                        <div class="mb-3">
                            <label for="budget_left{{ $club->clubID }}" class="form-label">Budget Left (₺)</label>
                            <input type="number" step="0.01" class="form-control" id="budget_left{{ $club->clubID }}" name="budget_left" value="{{ optional($club->budget)->budget_left ?? 0 }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
            <p class="text-muted">No clubs found.</p>
        @endforelse
    </div>
</main>
@endsection
