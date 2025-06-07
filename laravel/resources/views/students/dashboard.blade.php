@extends('layouts.app')

@section('title', 'Student Dashboard')


@section('content')
<!--start content-->

<main class="page-content">

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Forums</p>
                            <h4 class="">{{ $totalForums }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Forum Posts</p>
                            <h4 class="">{{ $totalPosts }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Upcoming Events</p>
                            <h4 class="">{{ $upcomingEvents }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Notifications</p>
                            <h4 class="">{{ $totalNotifications }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Recent Notifications</h6>
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">All Notifications</a></li>
                                <li><a class="dropdown-item" href="#">Unread Only</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Club</th>
                                    <th>Status</th>
                                    <th>Delivered</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentNotifications as $index => $notification)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $notification->title }}</td>
                                    <td>{{ $notification->club_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $notification->is_read ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $notification->is_read ? 'Read' : 'Unread' }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($notification->created_at)->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">My Club Roles</h6>
                    </div>
                    <div class="mt-3">
                        @forelse ($myClubRoles as $role)
                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                            <div>
                                <h6 class="mb-0">{{ $role['club']->name }}</h6>
                                <small class="text-muted">
                                    {{-- Eğer category varsa göster, yoksa General yaz --}}
                                    {{ $role['club']->category->name ?? 'General' }}
                                </small>
                            </div>
                            <span class="badge
                            @if ($role['type'] === 'leader') bg-primary
                            @elseif ($role['type'] === 'manager') bg-success
                            @else bg-secondary
                            @endif">
                                {{ ucfirst($role['type']) }}
                            </span>
                        </div>
                        @empty
                        <p class="text-muted mt-2">You are not part of any club yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>


    </div><!--end row-->

</main>
<!--end page main-->
@endsection
