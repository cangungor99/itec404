@extends('layouts.app')

@section('title', 'EMU Digital Club | Profile')

@section('content')
<!--start content-->
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3 text-white">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt text-white"></i></a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">User Profile</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="profile-cover bg-dark"></div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-0">My Account</h5>
                    <hr>
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">USER INFORMATION</h6>
                        </div>
                        <div class="card-body">
                            <form class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">Student No</label>
                                    <input type="text" class="form-control" value="@jhon">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Email address</label>
                                    <input type="text" class="form-control" value="xyz@example.com">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="jhon">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow-none border">
                        <div class="card-header">
                            <h6 class="mb-0">CONTACT INFORMATION</h6>
                        </div>
                        <div class="card-body">
                            <form class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" value="47-A, city name, United States">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" value="@jhon">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" value="xyz@example.com">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Pin Code</label>
                                    <input type="text" class="form-control" value="jhon">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="Deo">
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="text-start">
                        <button type="button" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body">
                    <div class="profile-avatar text-center">
                        <img src="assets/images/avatars/avatar-1.png" class="rounded-circle shadow" width="120" height="120" alt="">
                    </div>

                    <div class="text-center mt-4">
                        <h4 class="mb-1">Mustafa Bostan</h4>
                        <p class="mb-0 text-secondary">Information Technology</p>
                        <div class="mt-4"></div>
                        <h6 class="mb-1">HR Manager - Codervent Technology</h6>
                        <p class="mb-0 text-secondary">University of Information Technology</p>
                    </div>


                </div>

            </div>
        </div>
    </div><!--end row-->

</main>
<!--end page main-->
@endsection
