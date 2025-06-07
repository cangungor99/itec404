@extends('layouts.app')
@section('title', 'Pending Forums')
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
                    <li class="breadcrumb-item active" aria-current="page">Pending Forums</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow-sm radius-10 border-0 mb-4">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-hourglass-split text-warning me-2"></i>Forums Awaiting Approval</h4>

            @if($forums->isEmpty())
                <div class="alert alert-info">No pending forums found.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Club</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($forums as $forum)
                                <tr>
                                    <td>{{ $forum->title }}</td>
                                    <td>{{ $forum->club->name }}</td>
                                    <td>{{ $forum->user->name }} {{ $forum->user->surname }}</td>
                                    <td>{{ \Carbon\Carbon::parse($forum->created_at)->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route($prefix.'.forums.show', $forum->forumID) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> View
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
</main>
@endsection
