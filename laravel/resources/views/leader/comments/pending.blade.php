@extends('layouts.app')
@section('title', 'Pending Comments')
@php
    $prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
@endphp
@section('content')

<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Leader</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($prefix.'.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pending Comments</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow-sm radius-10 border-0 mb-4">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-chat-left-dots text-warning me-2"></i>Comments Awaiting Approval</h4>

            @if($comments->isEmpty())
                <div class="alert alert-info">No pending comments found.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Message</th>
                                <th>Forum Title</th>
                                <th>Club</th>
                                <th>By</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{ Str::limit($comment->message, 100) }}</td>
                                    <td>{{ $comment->forum->title }}</td>
                                    <td>{{ $comment->forum->club->name }}</td>
                                    <td>{{ $comment->user->name }} {{ $comment->user->surname }}</td>
                                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <form action="{{ route($prefix.'.comments.approve', $comment->commentID) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i></button>
                                        </form>
                                        <form action="{{ route($prefix.'.comments.reject', $comment->commentID) }}" method="POST" class="d-inline">
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
</main>
@endsection
