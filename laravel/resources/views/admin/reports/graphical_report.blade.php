@extends('layouts.app')
@section('title', 'Graphical Report')
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
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body">
                    <h5 class="card-title text-center">Members per Club</h5>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body">
                    <h5 class="card-title text-center">Budget Usage Distribution</h5>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body">
                    <h5 class="card-title text-center">Monthly Event Count</h5>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
