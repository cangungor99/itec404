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

    <title>EMU Digital Club | Admin Dashboard</title>
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
              <p>Total Clubs</p>
              <h4>12</h4>
            </div>
            <div class="w-50">
              <p class="mb-3 float-end text-success">+ 5% <i class="bi bi-arrow-up"></i></p>
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
              <p>Total Events</p>
              <h4>36</h4>
            </div>
            <div class="w-50">
              <p class="mb-3 float-end text-danger">- 2.1% <i class="bi bi-arrow-down"></i></p>
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
              <p>Total Budget</p>
              <h4>$124.6K</h4>
            </div>
            <div class="w-50">
              <p class="mb-3 float-end text-success">+ 12% <i class="bi bi-arrow-up"></i></p>
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
              <p>Total Users</p>
              <h4>415</h4>
            </div>
            <div class="w-50">
              <p class="mb-3 float-end text-success">+ 7.5% <i class="bi bi-arrow-up"></i></p>
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
            <h6 class="mb-0">Budget Distribution</h6>
            <div class="fs-5 ms-auto dropdown">
              <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">View All</a></li>
                <li><a class="dropdown-item" href="#">Export</a></li>
              </ul>
            </div>
          </div>
          <div id="chart5"></div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <h6 class="mb-0">Posts by Category</h6>
            <div class="fs-5 ms-auto dropdown">
              <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Posts</a></li>
                <li><a class="dropdown-item" href="#">Statistics</a></li>
              </ul>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-md-2 g-3 mt-2 align-items-center">
            <div class="col-lg-7 col-xl-7 col-xxl-8">
              <div class="by-device-container">
                <div class="piechart-legend">
                  <h2 class="mb-1">74%</h2>
                  <h6 class="mb-0">Most Active Category</h6>
                </div>
                <canvas id="chart6"></canvas>
              </div>
            </div>
            <div class="col-lg-5 col-xl-5 col-xxl-4">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                  <i class="bi bi-chat-dots-fill me-2 text-primary"></i> Forum - <span>54%</span>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                  <i class="bi bi-calendar-event-fill me-2 text-success"></i> Events - <span>28%</span>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                  <i class="bi bi-file-earmark-text-fill me-2 text-warning"></i> Docs - <span>18%</span>
                </li>
              </ul>
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
                Copyright © 2025. All right reserved.
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