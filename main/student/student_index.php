<!doctype html>
<html lang="en">



<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="../assets/css/dark-theme.css" rel="stylesheet" />
    <link href="../assets/css/light-theme.css" rel="stylesheet" />
    <link href="../assets/css/semi-dark.css" rel="stylesheet" />
    <link href="../assets/css/header-colors.css" rel="stylesheet" />

    <title>EMU Digital Club | Dashboard</title>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <?php include "navbar.php"; ?>
        <!--end top header-->

        <!--start sidebar -->
        <?php include "sidebar.php"; ?>
        <!--end sidebar -->

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

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--start footer-->
        <footer class="footer">
            <div class="footer-text">
                Copyright © 2022. All right reserved.
            </div>
        </footer>
        <!--end footer-->


        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->



    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/js/pace.min.js"></script>
    <script src="../assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="../assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <!--app-->
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/index3.js"></script>
    <script>
        new PerfectScrollbar(".best-product")
    </script>


</body>


</html>