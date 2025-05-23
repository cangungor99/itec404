@extends('layouts.app')
@section('title', 'Forum Detail')
@section('content')

<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('students.forums.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Forum Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Forum Title -->
    <div class="card shadow-sm mb-4 fade-in">
        <div class="card-body">
            <h3 class="fw-bold">
                <i class="bi bi-chat-dots text-primary me-2"></i> {{ $forum->title }}
            </h3>
            <p class="text-muted mb-0">{{ $forum->description }}</p>
        </div>
    </div>

    <!-- Forum Ana Mesaj (Sahibi) -->
    <div class="card mb-3 shadow-sm fade-in">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold mb-1"><i class="bi bi-person-circle me-1"></i>{{ $forum->user->name }} {{ $forum->user->surname }}</h6>
                <small class="text-muted">
                    <i class="bi bi-clock"></i>
                    {{ \Carbon\Carbon::parse($forum->created_at)->format('F d, Y - H:i') }}
                </small>
            </div>
            <p class="mt-2 mb-1">{{ $forum->description }}</p>
            <button class="btn btn-sm btn-outline-secondary" disabled><i class="bi bi-reply"></i> Reply</button>
        </div>
    </div>

    @foreach($forum->comments->where('status', 'approved')->where('parentID', null) as $comment)

    <!-- Ana yorum -->
    <div class="card mb-3 shadow-sm fade-in">
        <div class="card-body py-2">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold mb-1">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ $comment->user->name }} {{ $comment->user->surname }}
                </h6>
                <small class="text-muted">
                    <i class="bi bi-clock"></i>
                    {{ \Carbon\Carbon::parse($comment->created_at)->format('F d, Y - H:i') }}
                </small>
            </div>
            <p class="mt-2 mb-1">{{ $comment->message }}</p>

            <!-- Reply button (can show form via JS later) -->
            <form method="POST" action="{{ route('students.forums.comment', $forum->forumID) }}" class="mt-2">
                @csrf
                <input type="hidden" name="parentID" value="{{ $comment->commentID }}">
                <textarea name="message" class="form-control form-control-sm mb-2" rows="2" placeholder="Write a reply..." required></textarea>
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-send"></i> Reply
                </button>
            </form>
        </div>
    </div>

    <!-- Alt yorumlar (cevaplar) -->
    @foreach($comment->replies as $reply)
    <div class="ms-4 border-start ps-3">
        <div class="card mb-3 shadow-sm fade-in">
            <div class="card-body py-2">
                <div class="d-flex justify-content-between">
                    <h6 class="fw-bold mb-1">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ $reply->user->name }} {{ $reply->user->surname }}
                    </h6>
                    <small class="text-muted">
                        <i class="bi bi-clock"></i>
                        {{ \Carbon\Carbon::parse($reply->created_at)->format('F d, Y - H:i') }}
                    </small>
                </div>
                <p class="mt-2 mb-1">{{ $reply->message }}</p>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach

    <!-- Yorum Ekleme -->
    <div class="card shadow-sm mt-4 fade-in">
        <div class="card-body">
            <h5 class="fw-bold"><i class="bi bi-pencil-square me-2"></i>Add a Comment</h5>
            <form method="POST" action="{{ route('students.forums.comment', $forum->forumID) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="message" class="form-control" rows="4" placeholder="Write your message..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i> Post
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
