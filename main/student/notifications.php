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
        .notification-item {
            background-color: #fff;
            border-left: 4px solid #0d6efd;
            padding: 1.2rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .notification-item:hover {
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .notification-item.read {
            opacity: 0.7;
            border-left-color: #adb5bd;
        }

        .notification-header {
            font-weight: 500;
            font-size: 1.1rem;
            margin-bottom: 0.4rem;
        }

        .notification-meta {
            font-size: 0.85rem;
            color: #666;
        }

        .notification-content {
            font-size: 0.95rem;
            margin: 0.5rem 0 0.3rem;
        }
    </style>




    <title>EMU Digital Club | Notifications</title>
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
                            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="container">
                <div class="notification-item">
                    <div class="notification-header">
                        <i class="bi bi-bell-fill me-2 text-primary"></i> New Event Created
                    </div>
                    <div class="notification-meta">
                        <span><i class="bi bi-person"></i> Created by: <strong>Ayşe Yılmaz</strong></span> •
                        <span><i class="bi bi-building"></i> Club: <strong>Art Club</strong></span> •
                        <span> Role: <strong><i class="bi bi-star-fill text-warning"></i>Club Leader</strong></span> •
                        <span><i class="bi bi-clock"></i> Delivered: 2025-05-08 10:30</span>
                    </div>
                    <div class="notification-content">
                        The club has announced a new event this weekend. Join us for fun and creativity!
                    </div>
                </div>

                <div class="notification-item read">
                    <div class="notification-header">
                        <i class="bi bi-check-circle-fill me-2 text-success"></i> Vote Results Published
                    </div>
                    <div class="notification-meta">
                        <span><i class="bi bi-person"></i> Created by: <strong>Admin</strong></span> •
                        <span><i class="bi bi-building"></i> Club: <strong>Science Club</strong></span> •
                        <span>Role: <strong><i class="bi bi-shield-lock-fill text-danger"></i>Admin</strong></span> •
                        <span><i class="bi bi-clock"></i> Delivered: 2025-05-07 17:45</span>
                    </div>
                    <div class="notification-content">
                        Results for the Club President Election are now available. View the winner and statistics.
                    </div>
                </div>

                <div class="notification-item">
                    <div class="notification-header">
                        <i class="bi bi-chat-left-text-fill me-2 text-info"></i> New Message from Admin
                    </div>
                    <div class="notification-meta">
                        <span><i class="bi bi-person"></i> Created by: <strong>System</strong></span> •
                        <span><i class="bi bi-building"></i> Club: <strong>General</strong></span> •
                        <span>Role: <strong><i class="bi bi-cpu-fill text-secondary"></i> System</strong></span> •
                        <span><i class="bi bi-clock"></i> Delivered: 2025-05-05 14:20</span>
                    </div>
                    <div class="notification-content">
                        Please check your email for an important update about system maintenance.
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