@extends('layouts.app')
@section('title', 'Club Members')
@push('styles')
@php
$prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
@endphp
<style>
    .table td,
    .table th {
        vertical-align: middle;
        text-align: center;
        padding: 0.75rem;
    }

    .btn-danger:hover {
        background-color: #c82333;
        color: white;
    }
</style>
@endpush

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ $club->name }} Members</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Members</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow-sm radius-10 border-0 mb-3 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-people-fill"></i> Approved Members</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Student No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($memberships as $membership)
                        <tr>
                            <td>{{ $membership->user->userID }}</td>
                            <td>{{ $membership->user->std_no }}</td>
                            <td>{{ $membership->user->name }} {{ $membership->user->surname }}</td>
                            <td>{{ $membership->user->email }}</td>
                            <td>{{ $membership->joined_at }}</td>
                            <td>


                                @if($canManageRoles && $membership->user->userID !== $club->leaderID)
                                <form method="POST" action="{{ route($prefix . '.members.destroy', [$club->clubID, $membership->membershipID]) }}" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-person-dash-fill"></i> Remove
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('manager.club.set_leader', ['club' => $club->clubID, 'userID' => $membership->user->userID]) }}" class="d-inline ms-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-person-check-fill"></i> Make Leader
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No approved members found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "This user will be removed from the club.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, remove',
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
