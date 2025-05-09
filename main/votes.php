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

    <title>EMU Digital Club | Active Votes</title>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->

        <?php include  "navbar.php"; ?>
        <!--end top header-->

        <!--start sidebar -->
        <?php include "sidebar.php" ?>
        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Club</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Club Votes</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Club Votes</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th><i class="bi bi-card-text me-1"></i> Title</th>
                                <th><i class="bi bi-info-circle me-1"></i> Description</th>
                                <th><i class="bi bi-calendar-event me-1"></i> Start Date</th>
                                <th><i class="bi bi-clock-history me-1"></i> End Date</th>
                                <th><i class="bi bi-calendar-check me-1"></i> Created At</th>
                                <th><i class="bi bi-lightbulb-fill me-1"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="vote-row" data-title="Club of the Year" data-description="This vote selects the best student club of the year." data-status="active">
                                <td>Club of the Year</td>
                                <td>This vote selects the best student club of the year.</td>
                                <td>2025-05-01 08:00</td>
                                <td>2025-05-10 23:59</td>
                                <td>2025-04-28 14:20</td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr class="vote-row" data-title="Old Vote Example" data-description="This vote has already ended." data-status="inactive">
                                <td>Old Vote Example</td>
                                <td>This vote has already ended.</td>
                                <td>2025-04-01 09:00</td>
                                <td>2025-04-10 23:59</td>
                                <td>2025-03-28 11:15</td>
                                <td><span class="badge bg-danger">Inactive</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <!-- Voting Modal -->
        <div class="modal fade" id="votingModal" tabindex="-1" aria-labelledby="votingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="votingModalLabel">Voting Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" id="votingModalBody">
                        <!-- Dynamic content goes here -->
                    </div>
                </div>
            </div>
        </div>
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
    <!-- Modal Handling Script -->
    <script>
        document.querySelectorAll('.vote-row').forEach(row => {
            row.addEventListener('click', () => {
                const title = row.getAttribute('data-title');
                const description = row.getAttribute('data-description');
                const status = row.getAttribute('data-status');

                document.getElementById('votingModalLabel').innerText = title;
                const modalBody = document.getElementById('votingModalBody');

                if (status === 'active') {
                    modalBody.innerHTML = `
        <p>${description}</p>
        <div class="d-flex justify-content-around mt-4">
          <button class="btn btn-success btn-lg">
            <i class="bi bi-hand-thumbs-up me-1"></i> Yes
          </button>
          <button class="btn btn-danger btn-lg">
            <i class="bi bi-hand-thumbs-down me-1"></i> No
          </button>
        </div>
      `;
                } else {
                    modalBody.innerHTML = `
        <div class="alert alert-warning" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          This voting is currently inactive.
        </div>
      `;
                }

                const votingModal = new bootstrap.Modal(document.getElementById('votingModal'));
                votingModal.show();
            });
        });
    </script>


</body>


</html>