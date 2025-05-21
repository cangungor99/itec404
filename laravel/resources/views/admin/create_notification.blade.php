@extends('layouts.app')
@section('title', 'Create Notifications')
@push('styles')
<style>
    /* Genel form padding ve spacing */
    .card form .form-label {
        font-weight: 500;
    }

    .card form .form-control,
    .card form .form-select {
        transition: all 0.3s ease;
    }

    .card form .form-control:focus,
    .card form .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    /* Çoklu seçim kutusu yüksekliği */
    #targetUsers,
    #targetClubs {
        height: 150px;
    }

    /* Gönder butonu animasyonu */
    .btn-success:hover {
        background-color: #198754;
        box-shadow: 0 0 10px rgba(25, 135, 84, 0.5);
    }

    .btn-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    /* Mobil uyumluluk */
    @media (max-width: 768px) {
        .page-breadcrumb .breadcrumb-title {
            font-size: 1rem;
        }

        .card form .form-select,
        .card form .form-control {
            font-size: 0.95rem;
        }

        #targetUsers,
        #targetClubs {
            height: 120px;
        }
    }
</style>
@endpush
@section('content')
<!--start content-->
<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Notifications</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Notification</li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
    @endif


    <!-- Form Card -->
    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-bell-fill me-2"></i> Create New Notification</h5>
            <form action="{{ isset($notification) ? route('admin.notifications.update', $notification->notificationID) : route('admin.notifications.store') }}" method="POST">
                @csrf
                @if(isset($notification))
                @method('PUT')
                @endif

                <!-- Title -->
                <div class="mb-3">
                    <label for="notifTitle" class="form-label">Notification Title</label>
                    <input type="text" class="form-control" id="notifTitle" name="notifTitle" placeholder="Enter title" required
                        value="{{ old('notifTitle', $notification->title ?? '') }}">

                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="notifContent" class="form-label">Notification Content</label>
                    <textarea class="form-control" id="notifContent" name="notifContent" rows="4" required>{{ old('notifContent', $notification->content ?? '') }}</textarea>

                </div>

                <!-- Target Selection -->
                <div class="mb-3 row">
                    <!-- Users -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="targetUsers" class="form-label">Select Users</label>
                        <select class="form-select" id="targetUsers" name="userIDs[]" multiple>
                            @foreach($users as $user)
                            <option value="{{ $user->userID }}"
                                @if(isset($notificationUserIDs) && in_array($user->userID, $notificationUserIDs)) selected @endif>
                                {{ $user->name }} {{ $user->surname }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Clubs -->
                    <div class="col-md-6">
                        <label for="targetClubs" class="form-label">Select Club</label>
                        <select class="form-select" id="targetClubs" name="clubID" required>
                            <option disabled {{ !isset($notification) ? 'selected' : '' }} value="">Choose a club</option>
                            @foreach($clubs as $club)
                            <option value="{{ $club->clubID }}" {{ (isset($notification) && $notification->clubID == $club->clubID) ? 'selected' : '' }}>
                                {{ $club->name }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">
                        <i class="bi bi-x-circle"></i> Clear
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-fill"></i>
                        {{ isset($notification) ? 'Update Notification' : 'Send Notification' }}
                    </button>
                </div>
            </form>


        </div>
    </div>
</main>

<!--end page main-->
@endsection