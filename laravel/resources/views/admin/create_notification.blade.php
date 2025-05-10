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

    <!-- Form Card -->
    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-bell-fill me-2"></i> Create New Notification</h5>
            <form>
                <!-- Title -->
                <div class="mb-3">
                    <label for="notifTitle" class="form-label">Notification Title</label>
                    <input type="text" class="form-control" id="notifTitle" placeholder="Enter title">
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label for="notifContent" class="form-label">Notification Content</label>
                    <textarea class="form-control" id="notifContent" rows="4" placeholder="Write your message here..."></textarea>
                </div>

                <!-- Target Selection -->
                <div class="mb-3 row">
                    <!-- Users -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="targetUsers" class="form-label">Select Users</label>
                        <select class="form-select" id="targetUsers" multiple>
                            <option selected disabled>Choose users (optional)</option>
                            <option value="1">Ali Yılmaz</option>
                            <option value="2">Ayşe Demir</option>
                            <option value="3">Mehmet Kaya</option>
                        </select>
                    </div>

                    <!-- Clubs -->
                    <div class="col-md-6">
                        <label for="targetClubs" class="form-label">Select Clubs</label>
                        <select class="form-select" id="targetClubs" multiple>
                            <option selected disabled>Choose clubs (optional)</option>
                            <option value="1">Software Club</option>
                            <option value="2">Photography Club</option>
                            <option value="3">Entrepreneurship Club</option>
                        </select>
                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">
                        <i class="bi bi-x-circle"></i> Clear
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-fill"></i> Send Notification
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<!--end page main-->
@endsection
