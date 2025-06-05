@extends('layouts.app')
@section('title', 'Manager Dashboard')

@section('content')
<main class="page-content">
    <div class="container py-4">
        <h2 class="text-center mb-4">Welcome, Club Manager</h2>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm border-0 radius-10">
                    <div class="card-body text-center">
                        <i class="bi bi-building fs-2 text-primary"></i>
                        <h5 class="mt-2">Club Info</h5>
                        <a href="{{ route('manager.club.show') }}" class="btn btn-sm btn-outline-primary mt-2">View Club</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm border-0 radius-10">
                    <div class="card-body text-center">
                        <i class="bi bi-folder2-open fs-2 text-warning"></i>
                        <h5 class="mt-2">Resources</h5>
                        <a href="{{ route('manager.resources.index') }}" class="btn btn-sm btn-outline-warning mt-2">Manage Resources</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm border-0 radius-10">
                    <div class="card-body text-center">
                        <i class="bi bi-cash-stack fs-2 text-success"></i>
                        <h5 class="mt-2">Budget</h5>
                        <a href="{{ route('manager.budget.index') }}" class="btn btn-sm btn-outline-success mt-2">View Budget</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
