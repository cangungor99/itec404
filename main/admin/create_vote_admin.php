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

    <title>EMU Digital Club | Create Voting </title>
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
                            <li class="breadcrumb-item active" aria-current="page">Create Voting</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->

            <div class="card shadow-sm radius-10 border-0 mb-3 animate__animated animate__fadeIn">
                <div class="card-body">
                    <h4 class="mb-3"><i class="bi bi-bar-chart-steps me-2 text-primary"></i> Create a New Voting Session</h4>

                    <form action="create_vote_process.php" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Voting Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Board Elections 2025" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the purpose or rules of the vote..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>

                        <div id="options-container" class="mb-3">
                            <label class="form-label">Voting Options</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="options[]" placeholder="Option 1" required>
                                <button class="btn btn-outline-secondary remove-option" type="button"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="button" class="btn btn-light border add-option">
                                <i class="bi bi-plus-circle me-1"></i> Add Option
                            </button>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-send-check me-1"></i> Launch Voting
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Option JS -->
            <script>
                document.querySelector('.add-option').addEventListener('click', function() {
                    const container = document.getElementById('options-container');
                    const optionIndex = container.querySelectorAll('.input-group').length + 1;

                    const inputGroup = document.createElement('div');
                    inputGroup.className = 'input-group mb-2';
                    inputGroup.innerHTML = `
      <input type="text" class="form-control" name="options[]" placeholder="Option ${optionIndex}" required>
      <button class="btn btn-outline-secondary remove-option" type="button"><i class="bi bi-trash"></i></button>
    `;

                    container.appendChild(inputGroup);
                });

                document.getElementById('options-container').addEventListener('click', function(e) {
                    if (e.target.closest('.remove-option')) {
                        e.target.closest('.input-group').remove();
                    }
                });
            </script>


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