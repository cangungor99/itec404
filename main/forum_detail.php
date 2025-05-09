<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />

    <!-- Plugins -->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="assets/css/pace.min.css" rel="stylesheet" />

    <!-- Theme Styles -->
    <link href="assets/css/dark-theme.css" rel="stylesheet" />
    <link href="assets/css/light-theme.css" rel="stylesheet" />
    <link href="assets/css/semi-dark.css" rel="stylesheet" />
    <link href="assets/css/header-colors.css" rel="stylesheet" />

    <title>EMU Digital Club | Forum Detail</title>

    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
<div class="wrapper">
    <?php include "navbar.php"; ?>
    <?php include "sidebar.php"; ?>

    <main class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Club</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="forum.php"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Forum Detail</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Forum Title -->
        <div class="card shadow-sm mb-4 fade-in">
            <div class="card-body">
                <h3 class="fw-bold"><i class="bi bi-code-slash text-primary me-2"></i> Software Development Talks</h3>
                <p class="text-muted mb-0">A space to discuss algorithms, programming languages, and tech career paths.</p>
            </div>
        </div>

        <!-- Forum Posts -->
        <div class="card mb-3 shadow-sm fade-in">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="fw-bold mb-1"><i class="bi bi-person-circle me-1"></i>John Doe</h6>
                    <small class="text-muted"><i class="bi bi-clock"></i> May 6, 2025 - 14:32</small>
                </div>
                <p class="mt-2 mb-1">I think JavaScript is still dominating frontend development, but TypeScript is the real hero here!</p>
                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-reply"></i> Reply</button>
            </div>

            <!-- Nested Reply -->
            <div class="ms-4 mt-3 border-start ps-3">
                <div class="card mb-2">
                    <div class="card-body py-2">
                        <small class="fw-bold"><i class="bi bi-person-circle me-1"></i>Jane Smith</small>
                        <p class="mb-0">Totally agree! Type safety has saved me so many times.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Another Post -->
        <div class="card mb-3 shadow-sm fade-in">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="fw-bold mb-1"><i class="bi bi-person-circle me-1"></i>Michael Scott</h6>
                    <small class="text-muted"><i class="bi bi-clock"></i> May 7, 2025 - 09:10</small>
                </div>
                <p class="mt-2 mb-1">Don’t forget about Python! It’s still king in the AI world.</p>
                <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-reply"></i> Reply</button>
            </div>
        </div>

        <!-- Comment Form -->
        <div class="card shadow-sm mt-4 fade-in">
            <div class="card-body">
                <h5 class="fw-bold"><i class="bi bi-pencil-square me-2"></i>Add a Comment</h5>
                <form>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Write your message..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-send me-1"></i> Post</button>
                </form>
            </div>
        </div>
    </main>

    <div class="overlay nav-toggle-icon"></div>

    <footer class="footer">
        <div class="footer-text">Copyright © 2025. All right reserved.</div>
    </footer>

    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
</div>

<!-- Scripts -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/js/pace.min.js"></script>
<script src="assets/js/app.js"></script>

</body>
</html>
