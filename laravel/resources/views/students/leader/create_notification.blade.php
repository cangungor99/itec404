@extends('layouts.app')
@section('title', 'Create Notification')
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Notification</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Notification</li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="card shadow-sm radius-10 border-0 mb-3 animate__animated animate__fadeIn">
        <div class="card-body">
            <h5 class="mb-4"><i class="bi bi-megaphone"></i> Create New Notification</h5>
            <form>
                <div class="mb-3">
                    <label for="notificationTitle" class="form-label">Notification Title</label>
                    <input type="text" class="form-control" id="notificationTitle" placeholder="Enter a short title" required>
                </div>
                <div class="mb-3">
                    <label for="notificationContent" class="form-label">Notification Content</label>
                    <textarea class="form-control" id="notificationContent" rows="4" placeholder="Write your notification here..." required></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">Create Notification</button>
                </div>
            </form>

            <!-- Temporary success alert (static for now) -->
            <div class="alert alert-success alert-dismissible fade show mt-4 d-none" role="alert">
                Notification successfully created!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>


</main>
@endsection
