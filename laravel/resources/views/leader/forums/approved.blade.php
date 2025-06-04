@extends('layouts.app')
@section('title', 'Approved Forums')
@section('content')

<main class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Forums</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('leader.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Approved Forums</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Success alert -->
    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <!-- Forum list -->
    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeIn">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-chat-left-text me-2"></i>Approved Forum Topics</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Club</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($forums as $index => $forum)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $forum->title }}</td>
                                <td>{{ $forum->user->name }} {{ $forum->user->surname }}</td>
                                <td>{{ \Carbon\Carbon::parse($forum->created_at)->format('Y-m-d') }}</td>
                                <td>{{ $forum->club->name }}</td>
                                <td>
                                    <a href="{{ route('leader.forums.show', $forum->forumID) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <form method="POST" action="{{ route('leader.forums.destroy', $forum->forumID) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this forum and all its content?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No approved forums found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
@endsection
