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
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->userID }}</td>
                            <td>{{ $user->std_no }}</td>
                            <td>{{ $user->name }} {{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->memberships as $membership)
                                <div>
                                    <strong>{{ $membership->club->name }}</strong>
                                    <small class="text-muted">({{ ucfirst($membership->role) }})</small>
                                </div>
                                @endforeach
                                @if ($user->memberships->isEmpty())
                                <em>No club</em>
                                @endif
                            </td>

                            <td>{{ $user->created_at }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1 btn-edit-user"
                                    data-id="{{ $user->userID }}"
                                    data-stdno="{{ $user->std_no }}"
                                    data-name="{{ $user->name }}"
                                    data-surname="{{ $user->surname }}"
                                    data-email="{{ $user->email }}"
                                    data-roles="{{ implode(',', $user->roles->pluck('roleID')->toArray()) }}"
                                    data-clubid="{{ optional($user->memberships->first())->clubID }}"
                                    data-bs-toggle="modal" data-bs-target="#editUserModal">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>

                                <form action="{{ route('admin.users.destroy', $user->userID) }}" method="POST" class="d-inline delete-user-form" data-id="{{ $user->userID }}">
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content animate__animated animate__fadeIn shadow rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title" id="editUserModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="" id="editUserForm" class="p-4">
                @csrf
                @method('PUT')
                <input type="hidden" name="userID" id="userID">

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="studentNo" class="form-label">Student No</label>
                        <input type="text" class="form-control" id="studentNo" name="std_no">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="surname">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="roleSelect" class="form-label">Roles</label>
                    <select class="form-select" name="roles[]" id="roleSelect" multiple>
                        @foreach($roles as $role)
                        <option value="{{ $role->roleID }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Tip: Hold Ctrl / Command to select multiple roles.</small>
                </div>

                <!-- Leader-specific section, shown conditionally -->
                <div class="mb-3 d-none" id="clubSelectionBox">
                    <label for="clubSelect" class="form-label">Select Club for Leadership</label>
                    <select class="form-select" name="clubID" id="clubSelect">
                        <option value="">-- Select Club --</option>
                        @foreach ($clubs as $club)
                        <option value="{{ $club->clubID }}">{{ $club->name }}</option>
                        @endforeach
                    </select>


                    <small class="text-muted">Only required if role is Leader.</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check-circle me-1"></i>Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('
            success ') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

<!--end page main-->
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.btn-edit-user').on('click', function() {
        const userID = $(this).data('id');

        $('#editUserForm').attr('action', `/admin/user_list/update/${userID}`);
        $('#userID').val(userID);
        $('#studentNo').val($(this).data('stdno'));
        $('#firstName').val($(this).data('name'));
        $('#lastName').val($(this).data('surname'));
        $('#email').val($(this).data('email'));

        const roles = $(this).data('roles').toString().split(',');
        $('#roleSelect option').prop('selected', false);
        roles.forEach(role => {
            $(`#roleSelect option[value="${role}"]`).prop('selected', true);
        });

        const clubID = $(this).data('clubid');
        if (clubID) {
            $('#clubSelect').val(clubID);
            $('#clubSelectionBox').removeClass('d-none');
        } else {
            $('#clubSelect').val('');
            $('#clubSelectionBox').addClass('d-none');
        }

        const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
        modal.show();
    });
</script>


<script>
    document.querySelectorAll('.delete-user-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete this user?',
                text: "This action will delete the selected user!",
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
@push('scripts')
<script>
    document.getElementById('roleSelect').addEventListener('change', function() {
        const selectedRoles = Array.from(this.selectedOptions).map(opt => opt.text.toLowerCase());
        const showClubBox = selectedRoles.includes('leader') || selectedRoles.includes('manager');
        document.getElementById('clubSelectionBox').classList.toggle('d-none', !showClubBox);
    });
</script>
@endpush