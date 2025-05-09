<!doctype html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
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

  <title>Blank </title>
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
  <script src="../assets/js/pace.min.js"></script>
  <!--app-->
  <script src="../assets/js/app.js"></script>


</body>


</html>