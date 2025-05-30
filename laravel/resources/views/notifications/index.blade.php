@extends('layouts.app')
@section('title', 'Notifications')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
        @forelse($notifications as $notification)
            <div class="notification-item {{ $notification->is_read ? 'read' : '' }}">
                <div class="notification-header">
                    <i class="bi bi-bell-fill me-2 text-primary"></i> {{ $notification->title }}
                </div>
                <div class="notification-meta">
                    <span><i class="bi bi-person"></i> Created by: <strong>{{ $notification->creator_name ?? 'System' }}</strong></span> •
                    <span><i class="bi bi-building"></i> Club: <strong>{{ $notification->club_name ?? 'General' }}</strong></span> •
                    <span>Role:
                        <strong>
                            @if($notification->role === 'admin')
                                <i class="bi bi-shield-lock-fill text-danger"></i> Admin
                            @elseif($notification->role === 'leader')
                                <i class="bi bi-star-fill text-warning"></i> Club Leader
                            @else
                                <i class="bi bi-person-circle text-secondary"></i> Member
                            @endif
                        </strong>
                    </span> •
                    <span><i class="bi bi-clock"></i> Delivered: {{ $notification->created_at->format('Y-m-d H:i') }}</span>
                </div>
                <div class="notification-content">
                    {{ $notification->content }}
                </div>
            </div>
        @empty
            <p>No notifications found.</p>
        @endforelse

        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    </div>
</main>
@endsection
