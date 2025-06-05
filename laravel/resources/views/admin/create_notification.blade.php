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
<style>
    /* Form alanlarının uyumlu kenar boşlukları ve görünüm */
    .card form .form-label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #212529;
    }

    .card form .form-control,
    .card form .form-select {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .card form .form-control:focus,
    .card form .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    /* Radio butonlar arası boşluk */
    .form-check {
        margin-right: 1rem;
    }

    /* Dinamik seçim alanı kutuları */
    #targetUsers,
    #targetClubs {
        min-height: 140px;
        background-color: #f9f9f9;
        border-radius: 0.45rem;
        border: 1px solid #ced4da;
    }

    /* Buton stilleri */
    .btn-outline-secondary {
        border-radius: 0.375rem;
        padding: 0.45rem 1.2rem;
    }

    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
        border-radius: 0.375rem;
        padding: 0.45rem 1.4rem;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.4);
    }

    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        box-shadow: 0 0 10px rgba(108, 117, 125, 0.25);
    }

    /* Form genel spacing */
    form > div {
        margin-bottom: 1.5rem;
    }

    /* Mobil görünüm iyileştirmeleri */
    @media (max-width: 768px) {
        .form-label {
            font-size: 0.875rem;
        }

        .form-control,
        .form-select {
            font-size: 0.875rem;
            padding: 0.65rem;
        }

        .btn {
            font-size: 0.875rem;
            padding: 0.4rem 1rem;
        }

        #targetUsers,
        #targetClubs {
            height: 120px;
        }
    }

    /* Breadcrumb başlık uyumu */
    .breadcrumb-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #343a40;
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
    <form id="notificationForm" action="{{ isset($notification) ? route('admin.notifications.update', $notification->notificationID) : route('admin.notifications.store') }}" method="POST">
    @csrf
    @if(isset($notification))
    @method('PUT')
    @endif

    <!-- Title -->
    <div class="mb-4">
        <label for="notifTitle" class="form-label fw-medium">Notification Title</label>
        <input type="text" class="form-control shadow-sm" id="notifTitle" name="notifTitle" placeholder="Enter a concise title"
            value="{{ old('notifTitle', $notification->title ?? '') }}" required>
    </div>

    <!-- Content -->
    <div class="mb-4">
        <label for="notifContent" class="form-label fw-medium">Notification Content</label>
        <textarea class="form-control shadow-sm" id="notifContent" name="notifContent" rows="4"
            placeholder="Write your notification message here..." required>{{ old('notifContent', $notification->content ?? '') }}</textarea>
    </div>

    <!-- Send To Choice -->
    <div class="mb-4">
        <label class="form-label fw-medium d-block">Send To</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="targetType" id="sendToClub" value="club" checked>
            <label class="form-check-label" for="sendToClub">All Members of a Club</label>
        </div>
        <div class="form-check form-check-inline ms-3">
            <input class="form-check-input" type="radio" name="targetType" id="sendToUsers" value="users">
            <label class="form-check-label" for="sendToUsers">Specific Users</label>
        </div>
    </div>

    <!-- Club Select -->
    <div class="mb-4" id="clubSelection">
        <label for="targetClubs" class="form-label fw-medium">Select Club</label>
        <select class="form-select shadow-sm" id="targetClubs" name="clubID">
            <option disabled selected value="">Choose a club</option>
            @foreach($clubs as $club)
                <option value="{{ $club->clubID }}">{{ $club->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- User Select -->
    <div class="mb-4 d-none" id="userSelection">
        <label for="targetUsers" class="form-label fw-medium">Select Users</label>
        <select class="form-select shadow-sm" id="targetUsers" name="userIDs[]" multiple>
            @foreach($users as $user)
                <option value="{{ $user->userID }}">{{ $user->name }} {{ $user->surname }}</option>
            @endforeach
        </select>
        <div class="form-text">Hold Ctrl (Windows) or Command (Mac) to select multiple users.</div>
    </div>

    <!-- Submit -->
    <div class="d-flex justify-content-end mt-4">
        <button type="reset" class="btn btn-outline-secondary me-2">
            <i class="bi bi-x-circle me-1"></i> Clear
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-send-fill me-1"></i> {{ isset($notification) ? 'Update Notification' : 'Send Notification' }}
        </button>
    </div>
</form>



</main>

<!--end page main-->
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clubSelection = document.getElementById('clubSelection');
        const userSelection = document.getElementById('userSelection');
        const radios = document.querySelectorAll('input[name="targetType"]');

        function toggleTargetFields() {
            if (document.getElementById('sendToClub').checked) {
                clubSelection.classList.remove('d-none');
                userSelection.classList.add('d-none');
            } else {
                clubSelection.classList.add('d-none');
                userSelection.classList.remove('d-none');
            }
        }

        radios.forEach(radio => {
            radio.addEventListener('change', toggleTargetFields);
        });

        toggleTargetFields(); // page load default
    });
</script>
@endpush
