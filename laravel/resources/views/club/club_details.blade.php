@extends('layouts.app')
@section('title', 'EMU Digital Club | Club Detail')
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
                    <li class="breadcrumb-item active" aria-current="page">Club Detail</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->


    <div class="card border shadow-none">
        <div class="card-header py-3">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-6">
                    <h5 class="mb-0">IT Club</h5>
                </div>

            </div>
        </div>
        <div class="card-header py-2 bg-light">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <div class="">

                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">Club Logo</strong><br>

                        </address>
                    </div>
                </div>
                <div class="col">
                    <div class="">

                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">Club Description</strong><br>

                        </address>
                    </div>
                </div>
                <div class="col">
                    <div class="">
                        <small>Created At</small>
                        <div class=""><b>August 3,2012</b></div>
                        <div class="invoice-detail">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>CLUB COMMITTEE</th>

                            <th class="text-center" width="10%">ROLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="text-inverse">Mehmet</span><br>

                            </td>
                            <td class="text-center">Teacher</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-inverse">Ahmet</span><br>

                            </td>
                            <td class="text-center">Leader</td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-inverse">Fatma<br>

                            </td>
                            <td class="text-center">Leader As.</td>
                        </tr>
                    </tbody>
                </table>
            </div>



            <hr>
            <!-- begin invoice-note -->
            <div class="my-3">
                * If you joined that club do not need click button <br>
                <button type="button" class="btn btn-primary">Join Club</button>
            </div>
            <!-- end invoice-note -->
        </div>


    </div>

</main>
<!--end page main-->
@endsection
