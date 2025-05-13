@extends('layouts.app')
@section('title', 'Manage Votes')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Voting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Voting Lists</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 mb-4 animate__animated animate__fadeIn">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-card-checklist text-primary me-2"></i> Manage Voting Sessions</h4>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Static Sample Rows -->
                        <tr>
                            <td>1</td>
                            <td>Club President Election</td>
                            <td>2025-05-10 09:00</td>
                            <td>2025-05-12 18:00</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="edit_vote.php?id=1" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <a href="view_results.php?id=1" class="btn btn-outline-info btn-sm"><i class="bi bi-bar-chart-line"></i></a>
                                    <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Event Theme Selection</td>
                            <td>2025-05-01 10:00</td>
                            <td>2025-05-03 23:59</td>
                            <td><span class="badge bg-secondary">Ended</span></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="view_results.php?id=2" class="btn btn-outline-info btn-sm"><i class="bi bi-bar-chart-line"></i></a>
                                    <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <!-- End Sample -->
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-4">
                <a href="create_vote.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> New Voting
                </a>
            </div>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
