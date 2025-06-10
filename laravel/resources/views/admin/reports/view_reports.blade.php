@extends('layouts.app')
@section('title', 'View Reports')
@section('content')
<main class="page-content">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm radius-10 border-0">
                <div class="card-body text-center">
                    <i class="bi bi-building fs-2 text-primary"></i>
                    <h5 class="mt-2">Total Clubs</h5>
                    <h3>{{ $totalClubs }}</h3>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm radius-10 border-0">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-2 text-success"></i>
                    <h5 class="mt-2">Total Members</h5>
                    <h3>{{ $totalMembers }}</h3>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm radius-10 border-0">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack fs-2 text-warning"></i>
                    <h5 class="mt-2">Monthly Budget Used</h5>
                    <h3>${{ number_format($budgetUsed, 2) }}</h3>

                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm radius-10 border-0 mt-4">
        <div class="card-body">
            <h4 class="mb-3">Recent Club Activities</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Club</th>
                            <th>Activity</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentEvents as $event)
                        <tr>
                            <td>{{ $event->club->name }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d') }}</td>
                            <td>
                                @php
                                $now = \Carbon\Carbon::now();
                                $status = $event->start_time > $now ? 'Scheduled' :
                                ($event->end_time < $now ? 'Completed' : 'Ongoing' );
                                    @endphp
                                    <span class="badge 
                    {{ $status === 'Scheduled' ? 'bg-primary' : 
                       ($status === 'Completed' ? 'bg-success' : 'bg-warning') }}">
                                    {{ $status }}
                                    </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>


</main>
@endsection