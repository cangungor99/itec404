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
                        @foreach ($clubs as $club)
                        <tr>
                            <td>{{ $club->clubID }}</td>
                            <td>
                                <img src="{{ $club->photo }}" alt="{{ $club->name }}" class="rounded" width="40">
                            </td>
                            <td>{{ $club->name }}</td>
                            <td>{{ $club->description }}</td>
                            <td>
                                <span class="badge {{ $club->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $club->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $club->created_at }}</td>
                            <td>
                                <button
                                    class="btn btn-sm btn-warning me-1 edit-club-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editClubModal"
                                    data-id="{{ $club->clubID }}"
                                    data-name="{{ $club->name }}"
                                    data-description="{{ $club->description }}"
                                    data-status="{{ $club->status }}"
                                    data-photo="{{ $club->photo }}">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>

                                <form method="POST" action="{{ route('admin.clubs.destroy', $club->clubID) }}" class="d-inline delete-club-form">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
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
                <h5 class="modal-title" id="editClubModalLabel">
                    <i class="bi bi-pencil-square me-2"></i> Edit Club
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- ✅ FORM BAŞLANGICI -->
            <form id="editClubForm" method="POST" action="/admin/clubs/update/{{ $club->clubID }}">

                @csrf
                @method('PUT')
                <input type="hidden" name="clubID" id="editClubID">

                <div class="modal-body">
                    <!-- Club Name -->
                    <div class="mb-3">
                        <label for="clubName" class="form-label">Club Name</label>
                        <input type="text" class="form-control" id="clubName" name="clubName" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="clubDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="clubDescription" name="clubDescription" rows="3" required></textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="clubStatus" class="form-label">Status</label>
                        <select class="form-select" id="clubStatus" name="clubStatus" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Club Photo -->
                    <div class="mb-3">
                        <label for="clubPhoto" class="form-label">Club Photo (URL)</label>
                        <input type="text" class="form-control" id="clubPhoto" name="clubPhoto" required>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Changes
                    </button>
                </div>
            </form>
            <!-- ✅ FORM BİTİŞİ -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll('.edit-club-btn');
    const editForm = document.getElementById('editClubForm');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const clubID = button.dataset.id;
            const name = button.dataset.name;
            const description = button.dataset.description;
            const status = button.dataset.status;
            const photo = button.dataset.photo;

            // Form action'ı güncelle
            editForm.action = `/clubs/update/${clubID}`; // Çünkü route böyle


            // Alanlara veri yerleştir
            document.getElementById('editClubID').value = clubID;
            document.getElementById('clubName').value = name;
            document.getElementById('clubDescription').value = description;
            document.getElementById('clubStatus').value = status;
            document.getElementById('clubPhoto').value = photo;

            // Modal zaten Bootstrap tarafından tetikleniyor (data-bs-target ile)
        });
    });
});
</script>

<script>
document.querySelectorAll('.delete-club-form').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure to delete that club?',
            text: "The club will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endpush

