@extends('layouts.app')
@section('title', 'Edit Event')
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Event</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('leader.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title mb-4"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Event</h5>
            <form action="{{ route('leader.events.update', [$club->clubID, $event->eventID]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="eventTitle" class="form-label">Event Title</label>
                    <input type="text" name="title" class="form-control" id="eventTitle" value="{{ old('title', $event->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="eventDescription" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="eventDescription" rows="4">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="startTime" class="form-label">Start Time</label>
                        <input type="datetime-local" name="start_time" class="form-control" id="startTime"
                               value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="endTime" class="form-label">End Time</label>
                        <input type="datetime-local" name="end_time" class="form-control" id="endTime"
                               value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{ old('location', $event->location) }}" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-save me-2"></i>Update Event</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
