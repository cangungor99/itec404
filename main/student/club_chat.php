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

    <title>EMU Digital Club | Club Chat</title>
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
                    <img src="../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
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
            <div class="chat-wrapper">
                <div class="chat-sidebar">
                    <div class="chat-sidebar-header">
                        <div class="d-flex align-items-center">
                            <div class="chat-user-online">
                                <img src="../assets/images/avatars/avatar-1.png" width="45" height="45" class="rounded-circle" alt="" />
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0">Mustafa Bostan</p>
                            </div>
                           
                        </div>
                        <div class="mb-3"></div>
                        
                        <div class="chat-tab-menu mt-3">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="pill" href="javascript:;">
                                        <div class="font-24"><i class='bx bx-conversation'></i>
                                        </div>
                                        <div><small>Chats</small>
                                        </div>
                                    </a>
                                </li>
                               
                               
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="javascript:;">
                                        <div class="font-24"><i class='bx bx-bell'></i>
                                        </div>
                                        <div><small>Notifications</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat-sidebar-content">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-Chats">
                                <div class="p-3">
                                    <div class="meeting-button d-flex justify-content-between">
                                       
                                        <div class="dropdown"> <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" data-display="static"><i class='bx bxs-edit me-2'></i>New Chat<i class='bx bxs-chevron-down ms-2'></i></a>
                                            <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#">New Group Chat</a>
                                                <a class="dropdown-item" href="#">New Moderated Group</a>
                                                <a class="dropdown-item" href="#">New Chat</a>
                                                <a class="dropdown-item" href="#">New Private Conversation</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown mt-3"> <a href="#" class="text-uppercase text-secondary dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">Recent Chats <i class='bx bxs-chevron-down'></i></a>
                                        <div class="dropdown-menu"> <a class="dropdown-item" href="#">Recent Chats</a>
                                            <a class="dropdown-item" href="#">Hidden Chats</a>
                                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="#">Sort by Time</a>
                                            <a class="dropdown-item" href="#">Sort by Unread</a>
                                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="#">Show Favorites</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-list">
                                    <div class="list-group list-group-flush">
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-2.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Louis Litt</h6>
                                                    <p class="mb-0 chat-msg">You just got LITT up, Mike.</p>
                                                </div>
                                                <div class="chat-time">9:51 AM</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item active">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-3.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Harvey Specter</h6>
                                                    <p class="mb-0 chat-msg">Wrong. You take the gun....</p>
                                                </div>
                                                <div class="chat-time">4:32 PM</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-4.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Rachel Zane</h6>
                                                    <p class="mb-0 chat-msg">I was thinking that we could...</p>
                                                </div>
                                                <div class="chat-time">Wed</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-5.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Donna Paulsen</h6>
                                                    <p class="mb-0 chat-msg">Mike, I know everything!</p>
                                                </div>
                                                <div class="chat-time">Tue</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-6.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Jessica Pearson</h6>
                                                    <p class="mb-0 chat-msg">Have you finished the draft...</p>
                                                </div>
                                                <div class="chat-time">9/3/2020</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-7.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Harold Gunderson</h6>
                                                    <p class="mb-0 chat-msg">Thanks Mike! :)</p>
                                                </div>
                                                <div class="chat-time">12/3/2020</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-9.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Katrina Bennett</h6>
                                                    <p class="mb-0 chat-msg">I've sent you the files for...</p>
                                                </div>
                                                <div class="chat-time">16/3/2020</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-10.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Charles Forstman</h6>
                                                    <p class="mb-0 chat-msg">Mike, this isn't over.</p>
                                                </div>
                                                <div class="chat-time">18/3/2020</div>
                                            </div>
                                        </a>
                                        <a href="javascript:;" class="list-group-item">
                                            <div class="d-flex">
                                                <div class="chat-user-online">
                                                    <img src="../assets/images/avatars/avatar-11.png" width="42" height="42" class="rounded-circle" alt="" />
                                                </div>
                                                <div class="flex-grow-1 ms-2">
                                                    <h6 class="mb-0 chat-title">Jonathan Sidwell</h6>
                                                    <p class="mb-0 chat-msg">That's bullshit. This deal..</p>
                                                </div>
                                                <div class="chat-time">24/3/2020</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-header d-flex align-items-center">
                    <div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
                    </div>
                    <div>
                        <h4 class="mb-1 font-weight-bold">Harvey Inspector</h4>
                        <div class="list-inline d-sm-flex mb-0 d-none"> <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>Active Now</a>
                            <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
                            <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-images me-1'></i>Gallery</a>
                            <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
                            <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-search me-1'></i>Find</a>
                        </div>
                    </div>
                   
                </div>
                <div class="chat-content">
                    <div class="chat-content-leftside">
                        <div class="d-flex">
                            <img src="../assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 chat-time">Harvey, 2:35 PM</p>
                                <p class="chat-left-msg">Hi, harvey where are you now a days?</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-rightside">
                        <div class="d-flex ms-auto">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, 2:37 PM</p>
                                <p class="chat-right-msg">I am in USA</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-leftside">
                        <div class="d-flex">
                            <img src="../assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 chat-time">Harvey, 2:48 PM</p>
                                <p class="chat-left-msg">okk, what about admin template?</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-rightside">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, 2:49 PM</p>
                                <p class="chat-right-msg">i have already purchased the admin template</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-leftside">
                        <div class="d-flex">
                            <img src="../assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 chat-time">Harvey, 3:12 PM</p>
                                <p class="chat-left-msg">ohhk, great, which admin template you have purchased?</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-rightside">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, 3:14 PM</p>
                                <p class="chat-right-msg">i purchased dashtreme admin template from themeforest. it is very good product for web application</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-leftside">
                        <div class="d-flex">
                            <img src="../assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 chat-time">Harvey, 3:16 PM</p>
                                <p class="chat-left-msg">who is the author of this template?</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-rightside">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, 3:22 PM</p>
                                <p class="chat-right-msg">codervent is the author of this admin template</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-leftside">
                        <div class="d-flex">
                            <img src="../assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 chat-time">Harvey, 3:16 PM</p>
                                <p class="chat-left-msg">ohh i know about this author. he has good admin products in his portfolio.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-rightside">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, 3:30 PM</p>
                                <p class="chat-right-msg">yes, codervent has multiple admin templates. also he is very supportive.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-leftside">
                        <div class="d-flex">
                            <img src="../assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 chat-time">Harvey, 3:33 PM</p>
                                <p class="chat-left-msg">All the best for your target. thanks for giving your time.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat-content-rightside">
                        <div class="d-flex">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">you, 3:35 PM</p>
                                <p class="chat-right-msg">thanks Harvey</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-footer d-flex align-items-center">
                    <div class="flex-grow-1 pe-2">
                        <div class="input-group"> <span class="input-group-text"><i class='bx bx-smile'></i></span>
                            <input type="text" class="form-control" placeholder="Type a message">
                        </div>
                    </div>
                    <div class="chat-footer-menu"> <a href="javascript:;"><i class='bx bx-file'></i></a>
                        <a href="javascript:;"><i class='bx bxs-contact'></i></a>
                        <a href="javascript:;"><i class='bx bx-microphone'></i></a>
                        <a href="javascript:;"><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>
                </div>
                <!--start chat overlay-->
                <div class="overlay chat-toggle-btn-mobile"></div>
                <!--end chat overlay-->
            </div>
        </main>
        <!--end page main-->


        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--start footer-->
        <footer class="footer">
            <div class="footer-text">
                Copyright © 2022. All right reserved.
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
    <script src="../assets/js/app-chat-box.js"></script>


</body>


<!-- Mirrored from codervent.com/onedash/demo/ltr/app-chat-box.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 May 2025 18:58:59 GMT -->

</html>