@extends('layouts.app')

@section('title', 'Verify Email')

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
                            <h5 class="card-title">Email Verification Required</h5>
                            <p class="card-text mb-4">Please check your email and click on the verification link.</p>

                            @if (session('status') === 'verification-link-sent')
                                <div class="alert alert-success mb-3">
                                    A new verification link has been sent to your email address.
                                </div>
                            @endif

                            <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                                @csrf
                                <button type="submit" class="btn btn-primary radius-30 w-100">Resend Verification Email</button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-light radius-30 w-100">Logout</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
