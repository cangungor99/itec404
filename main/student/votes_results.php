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
        .result-card {
            transition: transform 0.3s ease;
        }

        .result-card:hover {
            transform: translateY(-5px);
        }

        .progress-ring {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .progress-ring__svg {
            transform: rotate(-90deg);
        }

        .progress-ring__circle--bg {
            fill: none;
            stroke: #eee;
            stroke-width: 10;
        }

        .progress-ring__circle {
            fill: none;
            stroke: #0d6efd;
            stroke-width: 10;
            stroke-linecap: round;
            stroke-dasharray: 314;
            stroke-dashoffset: 314;
            transition: stroke-dashoffset 1.5s ease;
        }

        .progress-ring__text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.25rem;
            font-weight: 500;
        }
    </style>




    <title>EMU Digital Club | Vote Results</title>
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
                <div class="breadcrumb-title pe-3">Votes</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Vote Results</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card text-center shadow border-0 result-card">
                        <div class="card-body">
                            <h5 class="card-title">Club President Election</h5>
                            <p class="text-muted">Ended on: 2025-05-01</p>
                            <div class="d-flex justify-content-center mb-3">
                                <div class="progress-ring" data-percentage="75">
                                    <svg class="progress-ring__svg" width="120" height="120">
                                        <circle class="progress-ring__circle--bg" cx="60" cy="60" r="50" />
                                        <circle class="progress-ring__circle" cx="60" cy="60" r="50" />
                                    </svg>
                                    <div class="progress-ring__text">75%</div>
                                </div>
                            </div>
                            <p class="fw-bold text-success"><i class="bi bi-trophy-fill"></i> Winner: Option A</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-center shadow border-0 result-card">
                        <div class="card-body">
                            <h5 class="card-title">Event Theme Selection</h5>
                            <p class="text-muted">Ended on: 2025-04-20</p>
                            <div class="d-flex justify-content-center mb-3">
                                <div class="progress-ring" data-percentage="35">
                                    <svg class="progress-ring__svg" width="120" height="120">
                                        <circle class="progress-ring__circle--bg" cx="60" cy="60" r="50" />
                                        <circle class="progress-ring__circle" cx="60" cy="60" r="50" />
                                    </svg>
                                    <div class="progress-ring__text">35%</div>
                                </div>
                            </div>
                            <p class="fw-bold text-primary"><i class="bi bi-star-fill"></i> Winner: Theme Blue</p>
                        </div>
                    </div>
                </div>
            </div>






        </main>
        <!--end page main-->


        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <script>
            document.querySelectorAll('.progress-ring').forEach(ring => {
                const percentage = parseFloat(ring.getAttribute('data-percentage'));
                const circle = ring.querySelector('.progress-ring__circle');
                const radius = circle.r.baseVal.value;
                const circumference = 2 * Math.PI * radius;
                const offset = circumference - (percentage / 100) * circumference;

                circle.style.strokeDasharray = `${circumference} ${circumference}`;
                circle.style.strokeDashoffset = circumference;

                setTimeout(() => {
                    circle.style.strokeDashoffset = offset;
                }, 300);
            });
        </script>


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