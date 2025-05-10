@extends('layouts.app')
@section('title', 'Manage Club')
@push('styles')
<style>
    /* ===== Modal içeriği stilleri ===== */
    .modal .form-label {
        font-weight: 500;
        color: #444;
    }

    .modal .form-control,
    .modal .form-select {
        border-radius: 6px;
        box-shadow: none;
        transition: all 0.2s ease-in-out;
    }

    .modal .form-control:focus,
    .modal .form-select:focus {
        border-color: #3b7ddd;
        box-shadow: 0 0 0 0.15rem rgba(59, 125, 221, 0.25);
    }

    /* ===== Modal buton stilleri ===== */
    .modal-footer .btn {
        min-width: 120px;
    }

    /* ===== Tablo responsive ve stil ===== */
    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
        padding: 0.75rem;
    }

    /* ===== Badge rengi özelleştirmesi ===== */
    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .badge.bg-secondary {
        background-color: #6c757d !important;
    }

    /* ===== Animasyonlar ===== */
    .animate__animated.animate__fadeInUp {
        animation-duration: 0.6s;
        animation-delay: 0.1s;
    }

    /* ===== Mobil uyumluluk: Tabloyu dikey yapıya çevir ===== */
    @media screen and (max-width: 768px) {
        .table thead {
            display: none;
        }

        .table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 10px;
        }

        .table tbody td {
            display: flex;
            justify-content: space-between;
            padding: 8px 12px;
            border: none;
            position: relative;
        }

        .table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #555;
        }

        .btn-group {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .btn-group .btn {
            width: 100%;
            margin: 5px 0;
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
                    <li class="breadcrumb-item active" aria-current="page">My Clubs</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto d-flex align-items-center gap-2">
            <a href="create_new_club.php" class="btn btn-success">
                <i class="bi bi-plus-circle-fill me-1"></i> Create New Club
            </a>

            <div class="btn-group">
                <button type="button" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">All Clubs</a>
                    <a class="dropdown-item" href="javascript:;">Active</a>
                    <a class="dropdown-item" href="javascript:;">Inactive</a>
                </div>
            </div>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 mb-3 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-diagram-3-fill"></i> My Managed Clubs</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-hash"></i> ID</th>
                            <th><i class="bi bi-image"></i> Logo</th>
                            <th><i class="bi bi-chat-dots-fill"></i> Name</th>
                            <th><i class="bi bi-card-text"></i> Description</th>
                            <th><i class="bi bi-activity"></i> Status</th>
                            <th><i class="bi bi-calendar-event"></i> Created At</th>
                            <th><i class="bi bi-gear-fill"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="../assets/images/clubs/software.png" alt="Software Club" class="rounded" width="40"></td>
                            <td>Software Club</td>
                            <td>Club for software enthusiasts and developers.</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>2023-06-10 15:30</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editClubModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="../assets/images/clubs/photo.png" alt="Photo Club" class="rounded" width="40"></td>
                            <td>Photography Club</td>
                            <td>Capture the world through the lens with us.</td>
                            <td><span class="badge bg-secondary">Inactive</span></td>
                            <td>2023-09-21 09:45</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editClubModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!--end page main-->

<!-- Edit Club Modal -->
<div class="modal fade animate__animated animate__zoomIn" id="editClubModal" tabindex="-1" aria-labelledby="editClubModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="editClubModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit Club</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Club Form -->
                <form>
                    <div class="mb-3">
                        <label for="clubName" class="form-label">Club Name</label>
                        <input type="text" class="form-control" id="clubName" value="Software Club">
                    </div>

                    <div class="mb-3">
                        <label for="clubDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="clubDescription" rows="3">Club for software enthusiasts and developers.</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="clubStatus" class="form-label">Status</label>
                        <select class="form-select" id="clubStatus">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="clubPhoto" class="form-label">Club Photo (URL)</label>
                        <input type="text" class="form-control" id="clubPhoto" value="../assets/images/clubs/software.png">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
