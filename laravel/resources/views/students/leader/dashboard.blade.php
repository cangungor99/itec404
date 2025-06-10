@extends('layouts.app')
@section('title', 'Leader Dashboard')
@section('content')
<main class="page-content">
    <!-- Info Cards -->
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
        <div class="col">
            <div class="card overflow-hidden radius-10 animate__animated animate__fadeInUp">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Club Members</p>
                            <h4>{{ $totalMembers }}</h4>
                        </div>
                        <div class="w-50 text-end">
                            <i class="bi bi-people-fill text-primary fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10 animate__animated animate__fadeInUp">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Upcoming Events</p>
                            <h4>{{ $upcomingEvents }}</h4>
                        </div>
                        <div class="w-50 text-end">
                            <i class="bi bi-calendar-event-fill text-success fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10 animate__animated animate__fadeInUp">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Forum Topics</p>
                            <h4>{{ $forumTopics }}</h4>

                        </div>
                        <div class="w-50 text-end">
                            <i class="bi bi-chat-dots-fill text-warning fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10 animate__animated animate__fadeInUp">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Pending Members</p>
                            <h4>{{ $pendingMembers->count() }}</h4>

                        </div>
                        <div class="w-50 text-end">
                            <i class="bi bi-person-check-fill text-danger fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Club Activities Overview -->
    <div class="row mt-4">
        <div class="col-12 col-xl-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Recent Events</h6>
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">All Events</a></li>
                                <li><a class="dropdown-item" href="#">Upcoming</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Event Title</th>
                                    <th>Start Time</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentEvents as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d H:i') }}</td>
                                    <td>{{ $event->location }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No recent events found.</td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <h6 class="mb-3">Pending Membership Requests</h6>
                    <ul class="list-group list-group-flush">
                        @forelse ($pendingMembers as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $member->user->name }} {{ $member->user->surname }}</span>
                            <span class="d-flex gap-1">
                                <form action="{{ route('leader.memberships.approve', $member->membershipID) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                        <i class="bi bi-check2"></i>
                                    </button>
                                </form>
                                <form action="{{ route('leader.memberships.reject', $member->membershipID) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                            </span>
                        </li>
                        @empty
                        <li class="list-group-item text-center">
                            No pending membership requests.
                        </li>
                        @endforelse

                    </ul>
                </div>
            </div>
        </div>
    </div>

    


</main>
<!--end page content-->
@endsection
@push('scripts')
<script>
    const ctxPoll = document.getElementById('pollChart')?.getContext('2d');
    if (ctxPoll) {
        new Chart(ctxPoll, {
            type: 'bar',
            data: {
                labels: {
                    !!json_encode($pollLabels) !!
                },
                datasets: [{
                    label: 'Votes',
                    data: {
                        !!json_encode($pollData) !!
                    },
                    backgroundColor: ['#0d6efd', '#ffc107', '#198754', '#dc3545', '#6f42c1']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: {
                            !!json_encode($pollTitle) !!
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
</script>

<script>
    const ctxRole = document.getElementById('roleChart').getContext('2d');
    new Chart(ctxRole, {
        type: 'pie',
        data: {
            labels: ['Member', 'Manager', 'President', 'Leader'],
            datasets: [{
                data: [65, 10, 5, 20],
                backgroundColor: ['#0dcaf0', '#ffc107', '#dc3545', '#198754']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endpush
