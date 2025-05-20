@extends('layouts.app')

@section('title', 'Forgot Password')

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
                        <img src="{{ asset('assets/images/error/forgot-password-frent-img.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title">Forgot Password?</h5>
                            <p class="card-text mb-5">Enter your registered email ID to reset the password</p>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}" class="form-body">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="inputEmailid" class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" required class="form-control form-control-lg radius-30" id="inputEmailid" placeholder="Email id">
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid gap-3">
                                            <button type="submit" class="btn btn-lg btn-primary radius-30">Send</button>
                                            <a href="{{ route('login') }}" class="btn btn-lg btn-light radius-30">Back to Login</a>
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
