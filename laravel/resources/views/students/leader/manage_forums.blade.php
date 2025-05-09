@extends('layouts.app')
@section('title', 'Manage Forums')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Forums</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Forums</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInDown mb-4">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-hourglass-split me-2"></i>Pending Forum Requests</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Requested At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Forum Title 1</td>
                            <td>John Doe</td>
                            <td>2025-05-09</td>
                            <td>
                                <button class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i> Approve</button>
                                <button class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i> Reject</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow-sm radius-10 border-0 animate__animated animate__fadeInUp">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-chat-dots me-2"></i>Forum Topics</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Photography Tips</td>
                            <td>Let's discuss how to shoot better portraits.</td>
                            <td>2025-05-07</td>
                            <td>
                                <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</main>
<!--end page main-->
@endsection
