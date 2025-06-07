@extends('layouts.app')
@section('title', 'Create Notification')

@push('styles')
    <style>
        .form-label {
            font-weight: 600;
        }
        .form-control, .form-select {
            border-radius: 0.5rem;
            padding: 0.75rem;
        }
        .btn-primary {
            font-weight: 500;
        }
    </style>
@endpush

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Notifications</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route(request()->route('role') . '.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Notification</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow-sm border-0 p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('notifications.store', ['role' => request()->route('role')]) }}">
            @csrf

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Notification Title</label>
                <input type="text" name="title" id="title" class="form-control shadow-sm" required>
            </div>

            <!-- Content -->
            <div class="mb-3">
                <label for="content" class="form-label">Notification Content</label>
                <textarea name="content" id="content" class="form-control shadow-sm" rows="5" required></textarea>
            </div>

            <!-- Club -->
            <div class="mb-3">
                <label for="clubID" class="form-label">Your Club</label>
                <select name="clubID" id="clubID" class="form-select shadow-sm" required>
                    <option value="">Select a club</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->clubID }}">{{ $club->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i> Send Notification
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
