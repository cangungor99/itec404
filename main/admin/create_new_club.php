<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />


    <!--Theme Styles-->
    <link href="assets/css/dark-theme.css" rel="stylesheet" />
    <link href="assets/css/light-theme.css" rel="stylesheet" />
    <link href="assets/css/semi-dark.css" rel="stylesheet" />
    <link href="assets/css/header-colors.css" rel="stylesheet" />
    <style>
        /* Form inputlar için animasyonlu odak efekti */
        form .form-control,
        form .form-select {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            border-radius: 6px;
        }

        form .form-control:focus,
        form .form-select:focus {
            border-color: #3b7ddd;
            box-shadow: 0 0 0 0.15rem rgba(59, 125, 221, 0.25);
        }

        /* Buton grubu düzeni */
        .d-flex.justify-content-end .btn {
            min-width: 130px;
        }

        /* Başlık ikonuyla hizalı */
        .card-title i {
            color: #198754;
            /* yeşil */
        }

        /* Mobil görünüm optimizasyonu */
        @media (max-width: 768px) {
            .breadcrumb-title {
                font-size: 1rem;
            }

            .d-flex.justify-content-end {
                flex-direction: column;
                align-items: stretch;
            }

            .d-flex.justify-content-end .btn {
                width: 100%;
                margin-top: 10px;
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
                <div class="breadcrumb-title pe-3">Clubs</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a href="clubs.php">My Clubs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create New Club</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card shadow-sm radius-10 border-0 mb-4 animate__animated animate__fadeInUp">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="bi bi-plus-circle-fill me-1"></i> Create New Club</h5>
                    <form action="create_new_club_process.php" method="post">
                        <div class="mb-3">
                            <label for="clubName" class="form-label">Club Name</label>
                            <input type="text" class="form-control" id="clubName" name="clubName" placeholder="Enter club name..." required>
                        </div>

                        <div class="mb-3">
                            <label for="clubDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="clubDescription" name="clubDescription" rows="4" placeholder="Describe the purpose of the club..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="clubStatus" class="form-label">Status</label>
                            <select class="form-select" id="clubStatus" name="clubStatus">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="clubPhoto" class="form-label">Club Logo URL</label>
                            <input type="url" class="form-control" id="clubPhoto" name="clubPhoto" placeholder="https://example.com/logo.png">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="clubs.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle-fill"></i> Create Club
                            </button>
                        </div>
                    </form>
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/js/pace.min.js"></script>
    <!--app-->
    <script src="assets/js/app.js"></script>


</body>


</html>