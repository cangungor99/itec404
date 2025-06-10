@extends('layouts.app')
@section('title', 'Student Forums')
@section('content')
<main class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('students.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Forums</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Create Forum Button -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createForumModal">
        <i class="bi bi-plus-circle me-1"></i> Create New Forum
    </button>

    <!-- Forum List -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold"><i class="bi bi-chat-dots me-2"></i>Forum Discussions</h4>
            <input type="text" class="form-control w-25" placeholder="Search forums..." disabled>
        </div>

        <div class="row">
            @forelse($forums as $forum)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-start border-4 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-chat-left-dots text-primary me-2"></i> {{ $forum->title }}
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit($forum->description, 100) }}</p>
                        <div class="d-flex justify-content-between mt-3">
                            <small class="text-secondary">
                                <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($forum->created_at)->format('M d, Y') }}
                            </small>
                            <a href="{{ route('students.forums.show', $forum->forumID) }}" class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">No forums found.</p>
            @endforelse
        </div>
    </div>

    <!-- Create New Forum Modal -->
    <div class="modal fade" id="createForumModal" tabindex="-1" aria-labelledby="createForumModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('students.forums.store') }}" method="POST" class="modal-content" enctype="multipart/form-data">

                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createForumModalLabel">
                        <i class="bi bi-pencil-square me-2"></i> Create New Forum
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="forumTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="forumTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="forumDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="forumDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="clubID" class="form-label">Select Club</label>
                        <select class="form-select" id="clubID" name="clubID" required>
                            <option selected disabled value="">Choose a club</option>
                            @foreach($clubs as $clubID => $club)
                            <option value="{{ $clubID }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Attachments</label>
                        <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
