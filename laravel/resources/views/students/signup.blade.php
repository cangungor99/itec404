@extends('layouts.app')

@section('title', 'Student Sign Up')

@php
    $hideNavbar = true;
    $hideSidebar = true;
@endphp

@section('content')
<main class="authentication-content">
    <div class="container-fluid">
        <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                        <img src="assets/images/error/login-img.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title">Sign Up</h5>
                            <p class="card-text mb-5">See your growth and get consulting support!</p>
                            <form class="form-body">


                                <div class="row g-3">
                                    <div class="col-12 ">
                                        <label for="inputName" class="form-label">Name</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                                            <input type="text" class="form-control radius-30 ps-5" id="inputName" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <label for="inputSurnName" class="form-label">Surname</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                                            <input type="text" class="form-control radius-30 ps-5" id="inputSurName" placeholder="Enter Surname">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <label for="stdno" class="form-label">Student Number</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                                            <input type="text" class="form-control radius-30 ps-5" id="inputstdNo" placeholder="Enter Student Number">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email Address</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                                            <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                                            <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">I Agree to the Trems & Conditions</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary radius-30">Sign in</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="mb-0">Already have an account? <a href="signin.php">Sign up here</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
