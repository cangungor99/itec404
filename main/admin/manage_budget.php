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
    <style>
        .club-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            transition: transform 0.3s ease;
            border-radius: 1rem;
        }

        .club-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 576px) {
            .club-card h5 {
                font-size: 1rem;
            }

            .club-card p {
                font-size: 0.9rem;
            }
        }
    </style>

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
                
            </div>
            <!--end breadcrumb-->

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="club-card shadow-sm p-4 rounded-4 animate__animated animate__fadeInUp">
                    <div class="d-flex align-items-center mb-3">
                        <img src="assets/images/clubs/club1.png" alt="Club Logo" class="me-3 rounded-circle border border-2" width="60" height="60">
                        <div>
                            <h5 class="mb-0"><i class="bi bi-people-fill me-1 text-primary"></i> Club Name</h5>
                        </div>
                    </div>
                    <p class="mb-1"><i class="bi bi-cash-coin text-success me-1"></i> <strong>Total Budget:</strong> 15,000₺</p>
                    <p class="mb-3"><i class="bi bi-wallet2 text-warning me-1"></i> <strong>Budget Left:</strong> 7,500₺</p>
                    <div class="text-end">
                        <a href="manage_budget.php?club_id=1" class="btn btn-outline-primary btn-sm animate__animated animate__fadeIn animate__delay-1s">
                            <i class="bi bi-gear me-1"></i> Manage Budget
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