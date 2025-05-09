@extends('layouts.app')
@section('title', 'Manage Events')
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
                    <li class="breadcrumb-item active" aria-current="page">Event Lists</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card border-0 shadow-sm radius-10 mb-3 animate__animated animate__fadeInUp">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-1 text-primary"><i class="bi bi-calendar-event me-2"></i>Annual Club Meetup</h5>
                <p class="text-muted mb-2"><i class="bi bi-clock me-1"></i> 2025-06-15 18:00 — 2025-06-15 21:00</p>
                <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> University Conference Hall</p>
                <p class="mb-0 text-secondary small"><i class="bi bi-info-circle me-1"></i>Let's gather to celebrate the club’s achievements and welcome new members!</p>
            </div>
            <div class="text-end">
                <a href="edit_event.php?id=1" class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-pencil-fill"></i></a>
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
            </div>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
