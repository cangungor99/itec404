@extends('layouts.app')

@section('title', 'Confirm Password')

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
                    <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                        <img src="{{ asset('assets/images/error/login-img.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title">Confirm Your Password</h5>
                            <p class="card-text mb-5">For security, please confirm your password before continuing.</p>

                            <form method="POST" action="{{ route('password.confirm') }}" class="form-body">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <div class="ms-auto position-relative">
                                            <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                <i class="bi bi-lock-fill"></i>
                                            </div>
                                            <input type="password" name="password" class="form-control radius-30 ps-5" id="inputPassword" required placeholder="Enter your password">
                                            @error('password')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid gap-3">
                                            <button type="submit" class="btn btn-primary radius-30">Confirm Password</button>
                                            <a href="{{ route('login') }}" class="btn btn-light radius-30">Back to Login</a>
                                        </div>
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
