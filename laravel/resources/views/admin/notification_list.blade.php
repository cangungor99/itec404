@extends('layouts.app')
@section('title', 'Notification List')
@push('styles')
<style>
    .transition:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.75rem;
        padding: 5px 8px;
        border-radius: 6px;
        margin: 1px;
    }

    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .table td,
        .table th {
            font-size: 0.85rem;
            white-space: nowrap;
        }
    }
</style>
@endpush
@section('content')
<!-- Page Content -->
<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notification Management</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Notification Panel -->
    <div class="card shadow-sm radius-10 border-0 mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                <div>
                    <h4 class="fw-bold mb-2"><i class="fas fa-bell me-2 text-primary"></i>All Notifications</h4>
                </div>
                <a href="create_notifications_admin.php" class="btn btn-primary shadow-sm d-flex align-items-center mt-2 mt-md-0">
                    <i class="fas fa-plus me-2"></i> Create Notification
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th><i class="fas fa-hashtag"></i></th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Created By</th>
                            <th class="d-none d-md-table-cell">Recipients</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notif)
                        <tr class="transition">
                            <td>{{ $notif->notificationID }}</td>
                            <td>{{ $notif->title }}</td>
                            <td>{{ Str::limit($notif->content, 50) }}</td>
                            <td>{{ $notif->creator_name ?? 'N/A' }}</td>
                            <td class="d-none d-md-table-cell">{{ $notif->club_name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($notif->created_at)->format('Y-m-d H:i') }}</td>
                            <td class="d-flex justify-content-center gap-1">

                                <!-- Edit butonu -->
                                <button class="btn btn-sm btn-warning me-1 btn-edit-notification"
                                    data-id="{{ $notif->notificationID }}"
                                    data-title="{{ $notif->title }}"
                                    data-content="{{ $notif->content }}"
                                    data-club="{{ $notif->club_name }}"
                                    data-date="{{ $notif->created_at }}"
                                    title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </button>



                                <!-- Delete butonu -->
                                <form action="{{ route('admin.notifications.destroy', $notif->notificationID) }}"
                                    method="POST" onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</main>
<!-- Edit Notification Modal -->
<div class="modal fade" id="editNotificationModal" tabindex="-1" aria-labelledby="editNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg animate__animated animate__fadeIn">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editNotificationModalLabel"><i class="fas fa-edit me-2"></i>Edit Notification</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editNotificationForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="notificationID" id="notificationID">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="notificationTitle" class="form-label"><i class="fas fa-heading me-1"></i> Title</label>
                        <input type="text" class="form-control" id="notificationTitle" placeholder="Enter notification title" required>
                    </div>
                    <div class="mb-3">
                        <label for="notificationContent" class="form-label"><i class="fas fa-align-left me-1"></i> Content</label>
                        <textarea class="form-control" id="notificationContent" rows="4" placeholder="Enter notification content" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notificationRecipients" class="form-label"><i class="fas fa-users me-1"></i> Recipients (comma separated)</label>
                        <input type="text" class="form-control" id="notificationRecipients" placeholder="#8, #14" required>
                    </div>
                    <div class="mb-3">
                        <label for="notificationDate" class="form-label"><i class="fas fa-clock me-1"></i> Created Date</label>
                        <input type="text" class="form-control" id="notificationDate" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // Sample edit button click handler
        $('.btn-edit-notification').on('click', function() {
            // You can fetch real data here
            $('#notificationTitle').val('Meeting Reminder');
            $('#notificationContent').val('Monthly meeting with club members will be held...');
            $('#notificationRecipients').val('#8, #14');
            $('#notificationDate').val('2025-05-09 10:23');

            $('#editNotificationModal').modal('show');
        });

        // Handle update form submission (optional)
        $('#editNotificationForm').on('submit', function(e) {
            e.preventDefault();
            // You would normally send an AJAX request here
            alert('Notification updated!');
            $('#editNotificationModal').modal('hide');
        });
    });
</script>
@endpush


@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-edit-notification').on('click', function () {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const content = $(this).data('content');
            const date = $(this).data('date');

            // Formu doldur
            $('#notificationID').val(id);
            $('#notificationTitle').val(title);
            $('#notificationContent').val(content);
            $('#notificationDate').val(date);

            // Form action'ı dinamik olarak ayarla
            $('#editNotificationForm').attr('action', `/admin/notifications/update/${id}`);

            // Modalı aç
            $('#editNotificationModal').modal('show');
        });
    });
</script>
@endpush
