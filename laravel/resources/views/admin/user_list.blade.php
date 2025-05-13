@extends('layouts.app')
@section('title', 'User List')
@push('styles')
<style>
    /* Kullanıcı tablosu için daha güzel spacing */
    .table td,
    .table th {
        vertical-align: middle;
        text-align: center;
        padding: 0.75rem;
    }

    /* Actions butonlarına hover efekti */
    .btn-warning:hover {
        background-color: #e0a800;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
        color: white;
    }

    /* Mobil uyumluluk için: */
    @media screen and (max-width: 768px) {
        .breadcrumb-title {
            font-size: 1rem;
        }

        .table thead {
            display: none;
        }

        .table tbody td {
            display: block;
            width: 100%;
            text-align: right;
            padding-left: 50%;
            position: relative;
        }

        .table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: bold;
            text-align: left;
        }

        .btn-group {
            display: block;
            width: 100%;
        }
    }
</style>
@endpush
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Users</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">User List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">All Users</a>
                    <a class="dropdown-item" href="javascript:;">Managers</a>
                    <a class="dropdown-item" href="javascript:;">Recent Sign-ups</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 mb-3 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-people-fill"></i> User List</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-hash"></i> ID</th>
                            <th><i class="bi bi-person-badge-fill"></i> Student No</th>
                            <th><i class="bi bi-person-lines-fill"></i> Name</th>
                            <th><i class="bi bi-envelope-fill"></i> Email</th>
                            <th><i class="bi bi-people-fill"></i> Clubs & Roles</th>
                            <th><i class="bi bi-calendar-event"></i> Joined At</th>
                            <th><i class="bi bi-gear-fill"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>202012345</td>
                            <td>Ali Yılmaz</td>
                            <td>ali.yilmaz@example.com</td>
                            <td>Software Club (leader), Entrepreneurship Club (member)</td>
                            <td>2023-09-01 10:15</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>202098765</td>
                            <td>Ayşe Demir</td>
                            <td>ayse.demir@example.com</td>
                            <td>Photography Club (manager)</td>
                            <td>2023-11-12 08:42</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>202056789</td>
                            <td>Mehmet Kaya</td>
                            <td>mehmet.kaya@example.com</td>
                            <td><em>Not a member of any club</em></td>
                            <td>2024-01-05 14:03</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content animate__animated animate__fadeIn">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel"><i class="bi bi-pencil-fill"></i> Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- User Info Form (static for now) -->
                <form>
                    <div class="mb-3">
                        <label for="studentNo" class="form-label">Student No</label>
                        <input type="text" class="form-control" id="studentNo" value="202012345">
                    </div>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" value="Ali Yılmaz">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" value="ali.yilmaz@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="clubs" class="form-label">Clubs & Roles</label>
                        <textarea class="form-control" id="clubs" rows="2">Software Club (leader), Entrepreneurship Club (member)</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Update User</button>
            </div>
        </div>
    </div>
</div>

<!--end page main-->
@endsection
