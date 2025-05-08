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

    <title>EMU Digital Club | Club Resources</title>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <?php include "navbar.php"; ?>
        <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">Onedash</h4>
                </div>
                <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bi bi-house-fill"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                    <ul>
                        <li> <a href="index-2.html"><i class="bi bi-circle"></i>Blue Dashboard 1</a>
                        </li>
                        <li> <a href="index2.html"><i class="bi bi-circle"></i>Blue Dashboard 2</a>
                        </li>
                        <li> <a href="index3.html"><i class="bi bi-circle"></i>Color Dashboard 1</a>
                        </li>
                        <li> <a href="index4.html"><i class="bi bi-circle"></i>Color Dashboard 2</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                        </div>
                        <div class="menu-title">Application</div>
                    </a>
                    <ul>
                        <li> <a href="app-emailbox.html"><i class="bi bi-circle"></i>Email</a>
                        </li>
                        <li> <a href="app-chat-box.html"><i class="bi bi-circle"></i>Chat Box</a>
                        </li>
                        <li> <a href="app-file-manager.html"><i class="bi bi-circle"></i>File Manager</a>
                        </li>
                        <li> <a href="app-to-do.html"><i class="bi bi-circle"></i>Todo List</a>
                        </li>
                        <li> <a href="app-invoice.html"><i class="bi bi-circle"></i>Invoice</a>
                        </li>
                        <li> <a href="app-fullcalender.html"><i class="bi bi-circle"></i>Calendar</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-label">UI Elements</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bi bi-droplet-fill"></i>
                        </div>
                        <div class="menu-title">Widgets</div>
                    </a>
                    <ul>
                        <li> <a href="widgets-static-widgets.html"><i class="bi bi-circle"></i>Static Widgets</a>
                        </li>
                        <li> <a href="widgets-data-widgets.html"><i class="bi bi-circle"></i>Data Widgets</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bi bi-basket2-fill"></i>
                        </div>
                        <div class="menu-title">eCommerce</div>
                    </a>
                    <ul>
                        <li> <a href="ecommerce-products-list.html"><i class="bi bi-circle"></i>Products List</a>
                        </li>
                        <li> <a href="ecommerce-products-grid.html"><i class="bi bi-circle"></i>Products Grid</a>
                        </li>
                        <li> <a href="ecommerce-products-categories.html"><i class="bi bi-circle"></i>Categories</a>
                        </li>
                        <li> <a href="ecommerce-orders.html"><i class="bi bi-circle"></i>Orders</a>
                        </li>
                        <li> <a href="ecommerce-orders-detail.html"><i class="bi bi-circle"></i>Order details</a>
                        </li>
                        <li> <a href="ecommerce-add-new-product.html"><i class="bi bi-circle"></i>Add New Product</a>
                        </li>
                        <li> <a href="ecommerce-add-new-product-2.html"><i class="bi bi-circle"></i>Add New Product 2</a>
                        </li>
                        <li> <a href="ecommerce-transactions.html"><i class="bi bi-circle"></i>Transactions</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-award-fill"></i>
                        </div>
                        <div class="menu-title">Components</div>
                    </a>
                    <ul>
                        <li> <a href="component-alerts.html"><i class="bi bi-circle"></i>Alerts</a>
                        </li>
                        <li> <a href="component-accordions.html"><i class="bi bi-circle"></i>Accordions</a>
                        </li>
                        <li> <a href="component-badges.html"><i class="bi bi-circle"></i>Badges</a>
                        </li>
                        <li> <a href="component-buttons.html"><i class="bi bi-circle"></i>Buttons</a>
                        </li>
                        <li> <a href="component-cards.html"><i class="bi bi-circle"></i>Cards</a>
                        </li>
                        <li> <a href="component-carousels.html"><i class="bi bi-circle"></i>Carousels</a>
                        </li>
                        <li> <a href="component-list-groups.html"><i class="bi bi-circle"></i>List Groups</a>
                        </li>
                        <li> <a href="component-media-object.html"><i class="bi bi-circle"></i>Media Objects</a>
                        </li>
                        <li> <a href="component-modals.html"><i class="bi bi-circle"></i>Modals</a>
                        </li>
                        <li> <a href="component-navs-tabs.html"><i class="bi bi-circle"></i>Navs & Tabs</a>
                        </li>
                        <li> <a href="component-navbar.html"><i class="bi bi-circle"></i>Navbar</a>
                        </li>
                        <li> <a href="component-paginations.html"><i class="bi bi-circle"></i>Pagination</a>
                        </li>
                        <li> <a href="component-popovers-tooltips.html"><i class="bi bi-circle"></i>Popovers & Tooltips</a>
                        </li>
                        <li> <a href="component-progress-bars.html"><i class="bi bi-circle"></i>Progress</a>
                        </li>
                        <li> <a href="component-spinners.html"><i class="bi bi-circle"></i>Spinners</a>
                        </li>
                        <li> <a href="component-notifications.html"><i class="bi bi-circle"></i>Notifications</a>
                        </li>
                        <li> <a href="component-avtars-chips.html"><i class="bi bi-circle"></i>Avatrs & Chips</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
                        </div>
                        <div class="menu-title">Icons</div>
                    </a>
                    <ul>
                        <li> <a href="icons-line-icons.html"><i class="bi bi-circle"></i>Line Icons</a>
                        </li>
                        <li> <a href="icons-boxicons.html"><i class="bi bi-circle"></i>Boxicons</a>
                        </li>
                        <li> <a href="icons-feather-icons.html"><i class="bi bi-circle"></i>Feather Icons</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-label">Forms & Tables</li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-file-earmark-break-fill"></i>
                        </div>
                        <div class="menu-title">Forms</div>
                    </a>
                    <ul>
                        <li> <a href="form-elements.html"><i class="bi bi-circle"></i>Form Elements</a>
                        </li>
                        <li> <a href="form-input-group.html"><i class="bi bi-circle"></i>Input Groups</a>
                        </li>
                        <li> <a href="form-layouts.html"><i class="bi bi-circle"></i>Forms Layouts</a>
                        </li>
                        <li> <a href="form-validations.html"><i class="bi bi-circle"></i>Form Validation</a>
                        </li>
                        <li> <a href="form-date-time-pickes.html"><i class="bi bi-circle"></i>Date Pickers</a>
                        </li>
                        <li> <a href="form-select2.html"><i class="bi bi-circle"></i>Select2</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        </div>
                        <div class="menu-title">Tables</div>
                    </a>
                    <ul>
                        <li> <a href="table-basic-table.html"><i class="bi bi-circle"></i>Basic Table</a>
                        </li>
                        <li> <a href="table-advance-tables.html"><i class="bi bi-circle"></i>Advance Tables</a>
                        </li>
                        <li> <a href="table-datatable.html"><i class="bi bi-circle"></i>Data Table</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-label">Pages</li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-lock-fill"></i>
                        </div>
                        <div class="menu-title">Authentication</div>
                    </a>
                    <ul>
                        <li> <a href="authentication-signin.html" target="_blank"><i class="bi bi-circle"></i>Sign In</a>
                        </li>
                        <li> <a href="authentication-signup.html" target="_blank"><i class="bi bi-circle"></i>Sign Up</a>
                        </li>
                        <li> <a href="authentication-signin-with-header-footer.html" target="_blank"><i class="bi bi-circle"></i>Sign In with Header & Footer</a>
                        </li>
                        <li> <a href="authentication-signup-with-header-footer.html" target="_blank"><i class="bi bi-circle"></i>Sign Up with Header & Footer</a>
                        </li>
                        <li> <a href="authentication-forgot-password.html" target="_blank"><i class="bi bi-circle"></i>Forgot Password</a>
                        </li>
                        <li> <a href="authentication-reset-password.html" target="_blank"><i class="bi bi-circle"></i>Reset Password</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="pages-user-profile.html">
                        <div class="parent-icon"><i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div class="menu-title">User Profile</div>
                    </a>
                </li>
                <li>
                    <a href="pages-timeline.html">
                        <div class="parent-icon"><i class="bi bi-collection-play-fill"></i>
                        </div>
                        <div class="menu-title">Timeline</div>
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="menu-title">Errors</div>
                    </a>
                    <ul>
                        <li> <a href="pages-errors-404-error.html" target="_blank"><i class="bi bi-circle"></i>404 Error</a>
                        </li>
                        <li> <a href="pages-errors-500-error.html" target="_blank"><i class="bi bi-circle"></i>500 Error</a>
                        </li>
                        <li> <a href="pages-errors-coming-soon.html" target="_blank"><i class="bi bi-circle"></i>Coming Soon</a>
                        </li>
                        <li> <a href="pages-blank-page.html" target="_blank"><i class="bi bi-circle"></i>Blank Page</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="pages-faq.html">
                        <div class="parent-icon"><i class="bi bi-question-lg"></i>
                        </div>
                        <div class="menu-title">FAQ</div>
                    </a>
                </li>
                <li>
                    <a href="pages-pricing-tables.html">
                        <div class="parent-icon"><i class="bi bi-tags-fill"></i>
                        </div>
                        <div class="menu-title">Pricing Tables</div>
                    </a>
                </li>
                <li class="menu-label">Charts & Maps</li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-bar-chart-line-fill"></i>
                        </div>
                        <div class="menu-title">Charts</div>
                    </a>
                    <ul>
                        <li> <a href="charts-apex-chart.html"><i class="bi bi-circle"></i>Apex</a>
                        </li>
                        <li> <a href="charts-chartjs.html"><i class="bi bi-circle"></i>Chartjs</a>
                        </li>
                        <li> <a href="charts-highcharts.html"><i class="bi bi-circle"></i>Highcharts</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-pin-map-fill"></i>
                        </div>
                        <div class="menu-title">Maps</div>
                    </a>
                    <ul>
                        <li> <a href="map-google-maps.html"><i class="bi bi-circle"></i>Google Maps</a>
                        </li>
                        <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Vector Maps</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-label">Others</li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-music-note-list"></i>
                        </div>
                        <div class="menu-title">Menu Levels</div>
                    </a>
                    <ul>
                        <li> <a class="has-arrow" href="javascript:;"><i class="bi bi-circle"></i>Level One</a>
                            <ul>
                                <li> <a class="has-arrow" href="javascript:;"><i class="bi bi-circle"></i>Level Two</a>
                                    <ul>
                                        <li> <a href="javascript:;"><i class="bi bi-circle"></i>Level Three</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="parent-icon"><i class="bi bi-file-code-fill"></i>
                        </div>
                        <div class="menu-title">Documentation</div>
                    </a>
                </li>
                <li>
                    <a href="https://themeforest.net/user/codervent" target="_blank">
                        <div class="parent-icon"><i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="menu-title">Support</div>
                    </a>
                </li>
            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Club</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Club Resources</li>
                        </ol>
                    </nav>
                </div>
               
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-12 col-xl-3">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div class="d-grid"> <a href="javascript:;" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add File</a>
                            </div>
                        </div>
                        <div class="fm-menu">
                            <div class="list-group list-group-flush m-3">
                                <a href="javascript:;" class="list-group-item py-1"><i class='bx bx-folder me-2 text-primary'></i><span>All Files</span></a>
                                
                                <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-file-earmark-break-fill me-2 text-info'></i><span>Documents</span></a>
                                <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-file-earmark-image-fill me-2 text-warning'></i><span>Images</span></a>
                                <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-camera-reels-fill me-2 text-primary'></i><span>Videos</span></a>
                                <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-play-btn-fill me-2 text-bronze'></i><span>Audio</span></a>
                                <a href="javascript:;" class="list-group-item py-1"><i class='bi bi-file-earmark-zip-fill me-2 text-option'></i><span>Zip Files</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-0 text-primary font-weight-bold">45.5 GB <span class="float-end text-secondary">50 GB</span></h5>
                            <p class="mb-0 mt-2"><span class="text-secondary">Used</span><span class="float-end text-primary"></span>
                            </p>
                            <hr>
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="fs-6 text-primary"><i class="bi bi-collection-play-fill"></i></div>
                                    <div>Media Files</div>
                                    <div class="ms-auto">100 GB</div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 65%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="fs-6 text-success"><i class="bi bi-images"></i></div>
                                    <div>Images</div>
                                    <div class="ms-auto">15 GB</div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 45%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="fs-6 text-warning"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                                    <div>Documents</div>
                                    <div class="ms-auto">7 GB</div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 45%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="fs-6 text-purple"><i class="bi bi-file-earmark-richtext-fill"></i></div>
                                    <div>Other Files</div>
                                    <div class="ms-auto">5 GB</div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 35%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="fs-6 text-secondary"><i class="bi bi-file-post-fill"></i></div>
                                    <div>Unknown Files</div>
                                    <div class="ms-auto">8 GB</div>
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"><i class="bi bi-search"></i></div>
                                <input class="form-control form-control-lg ps-5" type="text" placeholder="Search the files">
                            </div>
                           
                            <!--end row-->
                            <h5>Folders</h5>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-4">
                                    <div class="card shadow-none border radius-15">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="font-30 text-primary"><i class='bx bxs-folder'></i>
                                                </div>
                                                <div class="user-groups ms-auto">
                                                    <img src="assets/images/avatars/avatar-1.png" width="35" height="35" class="rounded-circle" alt="" />
                                                    <img src="assets/images/avatars/avatar-2.png" width="35" height="35" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="user-plus">+</div>
                                            </div>
                                            <h6 class="mb-0 text-primary">CLUB MEETINGS</h6>
                                            <small>15 files</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="card shadow-none border radius-15">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="font-30 text-primary"><i class='bx bxs-folder'></i>
                                                </div>
                                                <div class="user-groups ms-auto">
                                                    <img src="assets/images/avatars/avatar-4.png" width="35" height="35" class="rounded-circle" alt="" />
                                                </div>
                                            </div>
                                            <h6 class="mb-0 text-primary">PROJECTS</h6>
                                            <small>345 files</small>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!--end row-->

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Recent Files</h5>
                                </div>
                                <div class="ms-auto"><a href="javascript:;" class="btn btn-sm btn-outline-secondary">View all</a>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name <i class='bx bx-up-arrow-alt ms-2'></i>
                                            </th>
                                            <th>Uploaded By</th>
                                            <th>Last Modified</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div><i class='bx bxs-file-pdf me-2 font-24 text-danger'></i>
                                                    </div>
                                                    <div class="font-weight-bold text-danger">Competitor Analysis Template</div>
                                                </div>
                                            </td>
                                            <td>Only you</td>
                                            <td>Sep 3, 2019</td>
                                            <td><i class='bx bx-dots-horizontal-rounded font-24'></i>
                                            </td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!--end row-->
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