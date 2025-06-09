@extends('layouts.app')
@section('title', 'Manage Forums & Comments')
@php
$prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
@endphp
@section('content')
<main class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Forums</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($prefix.'.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Forums</li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pending Forums --}}
    <div class="card shadow-sm radius-10 border-0 mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3"><i class="bi bi-hourglass-split text-warning me-2"></i>Pending Forum Requests</h5>
            @if($pendingForums->isEmpty())
            <div class="alert alert-info">No pending forums.</div>
            @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Club</th>
                            <th>Created At</th>
                            <th>Attachments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingForums as $forum)
                        <tr>
                            <td>{{ $forum->title }}</td>
                            <td>{{ $forum->user->name }} {{ $forum->user->surname }}</td>
                            <td>{{ $forum->club->name }}</td>
                            <td>{{ $forum->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                @if($forum->attachments->isNotEmpty())
                                <ul class="mb-0">
                                    @foreach($forum->attachments as $file)
                                    <li><a href="{{ Storage::url($file->file_path) }}" target="_blank">
                                            {{ basename($file->file_path) }}
                                        </a></li>
                                    @endforeach
                                </ul>
                                @else
                                <span class="text-muted small">No file</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route($prefix.'.forums.approve', $forum->forumID) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i></button>
                                </form>
                                <form method="POST" action="{{ route($prefix.'.forums.reject', $forum->forumID) }}" class="reject-form d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button>
                                </form>
                                <a href="{{ route($prefix.'.forums.show', $forum->forumID) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>


    {{-- Pending Comments --}}
    <div class="card shadow-sm radius-10 border-0 mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3"><i class="bi bi-chat-left-dots text-info me-2"></i>Pending Comments</h5>
            @if($pendingComments->isEmpty())
            <div class="alert alert-info">No pending comments.</div>
            @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Message</th>
                            <th>Forum</th>
                            <th>Club</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Attachments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingComments as $comment)
                        <tr>
                            <td>{{ Str::limit($comment->message, 100) }}</td>
                            <td>{{ $comment->forum->title }}</td>
                            <td>{{ $comment->forum->club->name }}</td>
                            <td>{{ $comment->user->name }} {{ $comment->user->surname }}</td>
                            <td>{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                @if($comment->attachments->isNotEmpty())
                                <ul class="mb-0">
                                    @foreach($comment->attachments as $file)
                                    <li><a href="{{ Storage::url($file->file_path) }}" target="_blank">
                                            {{ basename($file->file_path) }}
                                        </a></li>
                                    @endforeach
                                </ul>
                                @else
                                <span class="text-muted small">No file</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route($prefix.'.comments.approve', $comment->commentID) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i></button>
                                </form>
                                <form method="POST" action="{{ route($prefix.'.comments.reject', $comment->commentID) }}" class="reject-form d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    {{-- Approved Forums --}}
    <div class="card shadow-sm radius-10 border-0 mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3"><i class="bi bi-chat-dots text-success me-2"></i>Approved Forums</h5>
            @if($approvedForums->isEmpty())
            <div class="alert alert-info">No approved forums.</div>
            @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Club</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($approvedForums as $forum)
                        <tr>
                            <td>{{ $forum->title }}</td>
                            <td>{{ $forum->user->name }} {{ $forum->user->surname }}</td>
                            <td>{{ $forum->club->name }}</td>
                            <td>{{ $forum->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route($prefix.'.forums.show', $forum->forumID) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form method="POST" action="{{ route($prefix.'.forums.destroy', $forum->forumID) }}" class="delete-forum-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

</main>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Forum veya yorum reddetme
    document.querySelectorAll('.reject-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "This will reject the content and it will no longer be visible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, reject it'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Forum silme
    document.querySelectorAll('.delete-forum-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Delete this forum?',
                text: "All related comments and attachments will be lost.",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
