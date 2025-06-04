@extends('layouts.app')
@section('title', 'Create Club')
@push('styles')
<style>
    /* Form inputlar için animasyonlu odak efekti */
    form .form-control,
    form .form-select {
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        border-radius: 6px;
    }

    form .form-control:focus,
    form .form-select:focus {
        border-color: #3b7ddd;
        box-shadow: 0 0 0 0.15rem rgba(59, 125, 221, 0.25);
    }

    /* Buton grubu düzeni */
    .d-flex.justify-content-end .btn {
        min-width: 130px;
    }

    /* Başlık ikonuyla hizalı */
    .card-title i {
        color: #198754;
        /* yeşil */
    }

    /* Mobil görünüm optimizasyonu */
    @media (max-width: 768px) {
        .breadcrumb-title {
            font-size: 1rem;
        }

        .d-flex.justify-content-end {
            flex-direction: column;
            align-items: stretch;
        }

        .d-flex.justify-content-end .btn {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>
@endpush
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Clubs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="clubs.php">My Clubs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create New Club</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 mb-4 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title mb-4"><i class="bi bi-plus-circle-fill me-1"></i> Create New Club</h5>
            <form method="POST" action="{{ route('admin.clubs.store') }}" enctype="multipart/form-data">


                @csrf

                <div class="mb-3">
                    <label for="clubName" class="form-label">Club Name</label>
                    <input type="text" class="form-control" id="clubName" name="clubName" placeholder="Enter club name..." required>
                </div>

                <div class="mb-3">
                    <label for="clubDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="clubDescription" name="clubDescription" rows="4" placeholder="Describe the purpose of the club..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="clubStatus" class="form-label">Status</label>
                    <select class="form-select" id="clubStatus" name="clubStatus">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="clubPhoto" class="form-label">Club Logo</label>
                    <input type="file" class="form-control" id="clubPhoto" name="clubPhoto" accept="image/*">
                </div>


                <div class="d-flex justify-content-end gap-2">
                    <a href="clubs.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle-fill"></i> Create Club
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<!--end page main-->
@endsection
