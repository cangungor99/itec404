@extends('layouts.app')
@section('title', 'Manager Dashboard')

@section('content')
<main class="page-content">
    <div class="container py-4">
        

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
            <div class="col">
                <div class="card radius-10 shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0"><i class="bi bi-people fs-1 text-primary"></i></div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Club Members</h6>
                            <h4 class="mb-0">{{ $totalMembers }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0"><i class="bi bi-calendar-event fs-1 text-success"></i></div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Upcoming Events</h6>
                            <h4 class="mb-0">{{ $upcomingEvents }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0"><i class="bi bi-cash-coin fs-1 text-warning"></i></div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Budget Used</h6>
                            <h4 class="mb-0">${{ number_format($usedBudget) }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-shrink-0"><i class="bi bi-exclamation-circle fs-1 text-danger"></i></div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Pending Requests</h6>
                            <h4 class="mb-0">{{ $pendingRequests }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="row mt-4">
            <div class="col-12 col-lg-6">
                <div class="card radius-10 border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-3">Recent Notifications</h6>
                        <ul class="list-group list-group-flush">
                            @forelse($recentNotifications as $notification)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $notification->title }}</strong><br>
                                        <small class="text-muted">{{ $notification->club_name }} | {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                    </div>
                                    @if(!$notification->is_read)
                                        <span class="badge bg-primary">New</span>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No notifications available.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-12 col-lg-6">
                <div class="card radius-10 border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-3">Quick Actions</h6>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary">Create Event</a>
                            <a href="#" class="btn btn-outline-warning">Send Notification</a>
                            <a href="#" class="btn btn-outline-success">Manage Budget</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
