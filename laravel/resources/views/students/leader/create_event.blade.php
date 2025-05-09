@extends('layouts.app')
@section('title', 'Create Event')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Event</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Event</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title mb-4"><i class="bi bi-calendar-plus me-2 text-primary"></i>Create New Event</h5>
            <form>
                <div class="mb-3">
                    <label for="eventTitle" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="eventTitle" placeholder="Enter event title">
                </div>
                <div class="mb-3">
                    <label for="eventDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="eventDescription" rows="4" placeholder="Describe the event..."></textarea>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="startTime" class="form-label">Start Time</label>
                        <input type="datetime-local" class="form-control" id="startTime">
                    </div>
                    <div class="col-md-6">
                        <label for="endTime" class="form-label">End Time</label>
                        <input type="datetime-local" class="form-control" id="endTime">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" placeholder="Enter location">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>Create Event</button>
                </div>
            </form>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
