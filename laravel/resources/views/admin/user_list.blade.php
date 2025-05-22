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
                            <td><em>Clubs to be implemented</em></td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                            <button class="btn btn-sm btn-warning me-1 btn-edit-user"
    data-id="{{ $user->userID }}"
    data-stdno="{{ $user->std_no }}"
    data-name="{{ $user->name }}"
    data-surname="{{ $user->surname }}"
    data-email="{{ $user->email }}"
    data-roles="{{ implode(',', $user->roles) }}"
    data-bs-toggle="modal" data-bs-target="#editUserModal">
    <i class="bi bi-pencil-fill"></i> Edit
</button>


                                <form action="{{ route('admin.users.destroy', $user->userID) }}" method="POST" class="d-inline">
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
    <div class="modal-content animate__animated animate__fadeIn">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel"><i class="bi bi-pencil-fill"></i> Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="POST" id="editUserForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="userID">
    <input type="text" name="std_no" id="studentNo">
    <input type="text" name="name" id="firstName">
    <input type="text" name="surname" id="lastName">
    <input type="email" name="email" id="email">
    
    <label>Roles</label>
    <select name="roles[]" id="roleSelect" class="form-select" multiple>
        @foreach($roles as $role)
            <option value="{{ $role->roleID }}">{{ $role->name }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-success">Update</button>
</form>

    </div>
  </div>
</div>


<!--end page main-->
@endsection
@push('scripts')
<script>
document.querySelectorAll('.edit-user-btn').forEach(button => {
    button.addEventListener('click', function () {
        const userID = this.dataset.id;

        // Form action URL'sini güncelle
        const form = document.getElementById('editUserForm');
        form.action = `/admin/users/update/${userID}`; // Route yapına göre ayarlanmalı

        // Diğer inputları doldur (örnek)
        document.getElementById('studentNo').value = this.dataset.stdno;
        document.getElementById('firstName').value = this.dataset.name;
        document.getElementById('lastName').value = this.dataset.surname;
        document.getElementById('email').value = this.dataset.email;

        // Roller
        const roles = this.dataset.roles.split(',');
        const roleSelect = document.getElementById('roleSelect');
        Array.from(roleSelect.options).forEach(option => {
            option.selected = roles.includes(option.value);
        });

        // Modalı göster
        new bootstrap.Modal(document.getElementById('editUserModal')).show();
    });
});

$('.btn-edit-user').on('click', function () {
    const userID = $(this).data('id');
    $('#editUserModal input[name="userID"]').val(userID);
    $('#studentNo').val($(this).data('stdno'));
    $('#firstName').val($(this).data('name'));
    $('#lastName').val($(this).data('surname'));
    $('#email').val($(this).data('email'));

    const roles = $(this).data('roles').toString().split(',');
    $('#roleSelect option').prop('selected', false);
    roles.forEach(role => {
        $(`#roleSelect option[value="${role}"]`).prop('selected', true);
    });
});

</script>
@endpush
