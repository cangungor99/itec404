@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<!--start content-->

<main class="page-content">

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Forums</p>
                            <h4 class="">12</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end text-success">+ 10% <i class="bi bi-arrow-up"></i></p>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Forum Posts</p>
                            <h4 class="">148</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end text-danger">- 5% <i class="bi bi-arrow-down"></i></p>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Upcoming Events</p>
                            <h4 class="">6</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end text-success">+ 20% <i class="bi bi-arrow-up"></i></p>
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Notifications</p>
                            <h4 class="">25</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end text-success">+ 12% <i class="bi bi-arrow-up"></i></p>
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">

                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Recent Notifications</h6>
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">All Notifications</a></li>
                                <li><a class="dropdown-item" href="#">Unread Only</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Club</th>
                                    <th>Status</th>
                                    <th>Delivered</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Meeting Today at 5PM</td>
                                    <td>Debate Club</td>
                                    <td><span class="badge bg-success">Read</span></td>
                                    <td>2025-05-07</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>New Event Announcement</td>
                                    <td>Drama Club</td>
                                    <td><span class="badge bg-warning text-dark">Unread</span></td>
                                    <td>2025-05-06</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Budget Report Uploaded</td>
                                    <td>Science Club</td>
                                    <td><span class="badge bg-success">Read</span></td>
                                    <td>2025-05-05</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Event Participation</h6>
                    </div>
                    <div class="mt-3" id="chart5"></div>
                    <div class="traffic-widget">
                        <div class="progress-wrapper mb-3">
                            <p class="mb-1">Going <span class="float-end">75%</span></p>
                            <div class="progress rounded-0" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;"></div>
                            </div>
                        </div>
                        <div class="progress-wrapper mb-3">
                            <p class="mb-1">Maybe <span class="float-end">15%</span></p>
                            <div class="progress rounded-0" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;"></div>
                            </div>
                        </div>
                        <div class="progress-wrapper mb-0">
                            <p class="mb-1">Not Going <span class="float-end">10%</span></p>
                            <div class="progress rounded-0" style="height: 8px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 10%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

</main>
<!--end page main-->
@endsection
