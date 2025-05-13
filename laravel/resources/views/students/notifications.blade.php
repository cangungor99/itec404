@extends('layouts.app')
@section('title', 'Notifications')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="container">
        <div class="notification-item">
            <div class="notification-header">
                <i class="bi bi-bell-fill me-2 text-primary"></i> New Event Created
            </div>
            <div class="notification-meta">
                <span><i class="bi bi-person"></i> Created by: <strong>Ayşe Yılmaz</strong></span> •
                <span><i class="bi bi-building"></i> Club: <strong>Art Club</strong></span> •
                <span> Role: <strong><i class="bi bi-star-fill text-warning"></i>Club Leader</strong></span> •
                <span><i class="bi bi-clock"></i> Delivered: 2025-05-08 10:30</span>
            </div>
            <div class="notification-content">
                The club has announced a new event this weekend. Join us for fun and creativity!
            </div>
        </div>

        <div class="notification-item read">
            <div class="notification-header">
                <i class="bi bi-check-circle-fill me-2 text-success"></i> Vote Results Published
            </div>
            <div class="notification-meta">
                <span><i class="bi bi-person"></i> Created by: <strong>Admin</strong></span> •
                <span><i class="bi bi-building"></i> Club: <strong>Science Club</strong></span> •
                <span>Role: <strong><i class="bi bi-shield-lock-fill text-danger"></i>Admin</strong></span> •
                <span><i class="bi bi-clock"></i> Delivered: 2025-05-07 17:45</span>
            </div>
            <div class="notification-content">
                Results for the Club President Election are now available. View the winner and statistics.
            </div>
        </div>

        <div class="notification-item">
            <div class="notification-header">
                <i class="bi bi-chat-left-text-fill me-2 text-info"></i> New Message from Admin
            </div>
            <div class="notification-meta">
                <span><i class="bi bi-person"></i> Created by: <strong>System</strong></span> •
                <span><i class="bi bi-building"></i> Club: <strong>General</strong></span> •
                <span>Role: <strong><i class="bi bi-cpu-fill text-secondary"></i> System</strong></span> •
                <span><i class="bi bi-clock"></i> Delivered: 2025-05-05 14:20</span>
            </div>
            <div class="notification-content">
                Please check your email for an important update about system maintenance.
            </div>
        </div>
    </div>
</main>
<!--end page main-->
@endsection
