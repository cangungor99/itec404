@extends('layouts.app')
@section('title', 'View Reports')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
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

    <div class="row">
        <!-- Total Clubs -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm radius-10 border-0">
                <div class="card-body text-center">
                    <i class="bi bi-building fs-2 text-primary"></i>
                    <h5 class="mt-2">Total Clubs</h5>
                    <h3>24</h3>
                </div>
            </div>
        </div>

        <!-- Total Members -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm radius-10 border-0">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-2 text-success"></i>
                    <h5 class="mt-2">Total Members</h5>
                    <h3>562</h3>
                </div>
            </div>
        </div>

        <!-- Budget Used -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm radius-10 border-0">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack fs-2 text-warning"></i>
                    <h5 class="mt-2">Monthly Budget Used</h5>
                    <h3>$12,340</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Activities Table -->
    <div class="card shadow-sm radius-10 border-0 mt-4">
        <div class="card-body">
            <h4 class="mb-3">Recent Club Activities</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Club</th>
                            <th>Activity</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tech Club</td>
                            <td>Hackathon 2025</td>
                            <td>2025-06-01</td>
                            <td><span class="badge bg-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td>Art Club</td>
                            <td>Art Exhibition</td>
                            <td>2025-05-28</td>
                            <td><span class="badge bg-primary">Scheduled</span></td>
                        </tr>
                        <tr>
                            <td>Music Club</td>
                            <td>Spring Concert</td>
                            <td>2025-05-21</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
