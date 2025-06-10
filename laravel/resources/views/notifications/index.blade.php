@extends('layouts.app')
@section('title', 'Notifications')
@push('styles')
<style>
    .notification-item {
        background-color: #fff;
        border-left: 4px solid #0d6efd;
        padding: 1.2rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .notification-item.read {
        opacity: 0.7;
        border-left-color: #adb5bd;
    }

    .notification-header {
        font-weight: 500;
        font-size: 1.1rem;
        margin-bottom: 0.4rem;
    }

    .notification-meta {
        font-size: 0.85rem;
        color: #666;
    }

    .notification-content {
        font-size: 0.95rem;
        margin: 0.5rem 0 0.3rem;
    }
</style>
@endpush

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><i class="bx bx-home-alt"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
    @forelse($notifications as $notification)
        <div class="notification-item {{ $notification->is_read ? 'read' : '' }}"
            onclick="openNotificationModal(this)"
            data-id="{{ $notification->notificationID }}"
            data-title="{{ $notification->title }}"
            data-content="{{ $notification->content }}"
            data-creator="{{ $notification->creator_name ?? 'System' }}"
            data-club="{{ $notification->club_name ?? 'General' }}"
            data-role="@if($notification->role === 'admin') Admin @elseif($notification->role === 'leader') Club Leader @else Member @endif"
            data-created="{{ $notification->created_at->format('Y-m-d H:i') }}"
            data-read="{{ $notification->is_read ? '1' : '0' }}"
        >
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

<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header">
        <h5 class="modal-title" id="notifModalLabel">Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="fw-bold" id="modalNotifTitle"></p>
        <p id="modalNotifContent"></p>
        <hr>
        <div class="text-muted small">
            <div><i class="bi bi-person"></i> <span id="modalNotifCreator"></span></div>
            <div><i class="bi bi-building"></i> <span id="modalNotifClub"></span></div>
            <div><i class="bi bi-shield-check"></i> <span id="modalNotifRole"></span></div>
            <div><i class="bi bi-clock"></i> <span id="modalNotifDate"></span></div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
    function openNotificationModal(el) {
        const id = el.dataset.id;
        const isRead = el.dataset.read === "1";

        document.getElementById("modalNotifTitle").innerText = el.dataset.title;
        document.getElementById("modalNotifContent").innerText = el.dataset.content;
        document.getElementById("modalNotifCreator").innerText = el.dataset.creator;
        document.getElementById("modalNotifClub").innerText = el.dataset.club;
        document.getElementById("modalNotifRole").innerText = el.dataset.role;
        document.getElementById("modalNotifDate").innerText = el.dataset.created;

        const modal = new bootstrap.Modal(document.getElementById('notificationModal'));
        modal.show();

        if (!isRead) {
            fetch(`/notifications/read/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                el.classList.add('read');
                el.dataset.read = "1";
                el.querySelector('i.bi').className = 'bi bi-check-circle-fill me-2 text-success';
            });
        }
    }
</script>
@endpush
