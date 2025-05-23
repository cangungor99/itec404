@extends('layouts.app')
@section('title', 'Forum Detail')
@section('content')

<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Leader</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('leader.forums.pending') }}"><i class="bx bx-home-alt"></i></a></li>
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
            <p class="text-muted mb-2">{{ $forum->description }}</p>
            <p class="mb-0"><strong>Created by:</strong> {{ $forum->user->name }} {{ $forum->user->surname }}</p>

            <!-- Onay / Red Butonları -->
            @if($forum->status === 'pending')
                <div class="mt-3">
                    <form action="{{ route('leader.forums.approve', $forum->forumID) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i> Approve</button>
                    </form>
                    <form action="{{ route('leader.forums.reject', $forum->forumID) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i> Reject</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Yorumlar -->
    @foreach($forum->comments->where('parentID', null) as $comment)
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
            </div>
        </div>

        <!-- Cevaplar -->
        @foreach($comment->replies as $reply)
            <div class="ms-4 border-start ps-3">
                <div class="card mb-2 shadow-sm">
                    <div class="card-body py-2">
                        <small class="fw-bold"><i class="bi bi-person-circle me-1"></i>{{ $reply->user->name }}</small>
                        <p class="mb-0">{{ $reply->message }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

    <!-- Lider Yorum Formu -->
    <div class="card shadow-sm mt-4 fade-in">
        <div class="card-body">
            <h5 class="fw-bold"><i class="bi bi-pencil-square me-2"></i>Leave a Comment</h5>
            <form method="POST" action="{{ route('students.forums.comment', $forum->forumID) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="message" class="form-control" rows="4" placeholder="Write your comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send me-1"></i> Post</button>
            </form>
        </div>
    </div>

</main>
@endsection
