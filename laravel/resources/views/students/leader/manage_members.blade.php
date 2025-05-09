@extends('layouts.app')
@section('title', 'Manage Members')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Club Members</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp mb-4">
        <div class="card-body">
            <h5 class="mb-3"><i class="bi bi-person-check me-2 text-primary"></i> Pending Join Requests</h5>
            <div class="d-flex flex-wrap gap-3">
                <!-- Tek bir istek örneği -->
                <div class="border p-3 rounded bg-light flex-fill" style="min-width:250px;">
                    <h6 class="mb-1">John Doe</h6>
                    <p class="text-muted small mb-2">Requested on: 2025-05-10</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-success"><i class="bi bi-check-circle"></i> Accept</button>
                        <button class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i> Reject</button>
                    </div>
                </div>
                <!-- Diğer istekler de benzer şekilde -->
            </div>
        </div>
    </div>

    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="mb-3"><i class="bi bi-people-fill me-2 text-primary"></i> Members of the Club</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Joined At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jane Smith</td>
                            <td>
                                <span class="badge bg-primary">President</span>
                            </td>
                            <td>2025-01-12</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Diğer üyeler -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
