@extends('layouts.app')
@section('title', 'EMU Digital Club | Active Votes')

@section('content')
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('students.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Club Votes</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Club Votes</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-card-text me-1"></i> Title</th>
                        <th><i class="bi bi-info-circle me-1"></i> Description</th>
                        <th><i class="bi bi-calendar-event me-1"></i> Start Date</th>
                        <th><i class="bi bi-clock-history me-1"></i> End Date</th>
                        <th><i class="bi bi-calendar-check me-1"></i> Created At</th>
                        <th><i class="bi bi-lightbulb-fill me-1"></i> Status</th>
                        <th><i class="bi bi-hand-index me-1"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($votings as $voting)
                        @php
                            $now = \Carbon\Carbon::now();
                            $end = \Carbon\Carbon::parse($voting->end_date);
                            $status = $now->lt($end) ? 'Active' : 'Ended';
                            $badgeClass = $status === 'Active' ? 'bg-success' : 'bg-secondary';
                            $buttonLabel = $status === 'Active' ? 'Vote' : 'Show Results';
                        @endphp
                        <tr>
                            <td>{{ $voting->title }}</td>
                            <td>{{ $voting->description }}</td>
                            <td>{{ $voting->start_date }}</td>
                            <td>{{ $voting->end_date }}</td>
                            <td>{{ $voting->created_at }}</td>
                            <td><span class="badge {{ $badgeClass }}">{{ $status }}</span></td>
                            <td>
                                <a href="{{ route('students.votes.show', $voting->votingID) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> {{ $buttonLabel }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No votes available for your clubs.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
