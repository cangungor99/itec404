@extends('layouts.app')
@section('title', 'EMU Digital Club | Club Lists')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Clubs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Active Club Lists</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header py-3">
            <div class="row align-items-center m-0">
                <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                    <select class="form-select">
                        <option>All category</option>
                        <option>IT</option>
                        <option>Sport</option>

                    </select>
                </div>

                <div class="col-md-2 col-6">
                    <select class="form-select">
                        <option>Status</option>
                        <option>Active</option>
                        <option>Disabled</option>
                        <option>Show all</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle table-striped">
                    <thead class="">
                        <th>
                            Select
                        </th>
                        <th>
                            Club Logo
                        </th>
                        <th>

                            Club Name
                        </th>
                        <th>
                            Club Description
                        </th>
                        <th>
                            Created Date
                        </th>
                        <th>
                            Actions
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </td>
                            <td class="productlist">
                                <a class="d-flex align-items-center gap-2" href="#">
                                    <div class="product-box">
                                        <img src="assets/images/products/01.png" alt="">
                                    </div>

                                </a>
                            </td>
                            <td><span>
                                    <div>
                                        <h6 class="mb-0 product-title">IT Club</h6>
                                    </div>
                                </span></td>
                            <td>
                                <!-- <span class="badge rounded-pill bg-success">Active</span> -->
                            </td>
                            <td><span>5-31-2020</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <nav class="float-end mt-4" aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>

        </div>
    </div>

</main>
<!--end page main-->
@endsection
