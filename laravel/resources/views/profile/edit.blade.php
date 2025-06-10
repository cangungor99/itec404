@extends('layouts.app')

@section('title', 'EMU Digital Club | Profile')

@section('content')
<main class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3 text-white">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}"><i class="bx bx-home-alt text-white"></i></a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">User Profile</li>
                </ol>
            </nav>
        </div>
    </div>

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
                            <form action="{{ route('profile.update') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="col-6">
                                    <label for="std_no" class="form-label">Student No</label>
                                    <input
                                        type="text"
                                        id="std_no"
                                        name="std_no"
                                        class="form-control @error('std_no') is-invalid @enderror"
                                        value="{{ old('std_no', $user->std_no) }}"
                                        required>
                                    @error('std_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="email" class="form-label">Email address</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}"
                                        required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="name" class="form-label">First Name</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}"
                                        required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="surname" class="form-label">Last Name</label>
                                    <input
                                        type="text"
                                        id="surname"
                                        name="surname"
                                        class="form-control @error('surname') is-invalid @enderror"
                                        value="{{ old('surname', $user->surname) }}"
                                        required>
                                    @error('surname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="profile_photo" class="form-label">Profile Photo</label>
                                    <input
                                        type="file"
                                        id="profile_photo"
                                        name="profile_photo"
                                        class="form-control @error('profile_photo') is-invalid @enderror">
                                    @error('profile_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-start mt-3">
                                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body text-center">
                    <div class="profile-avatar mb-3">
                        <img
                            src="{{ asset('storage/profile_photos/' . ($user->profile_photo ?? 'default.png')) }}"
                            class="rounded-circle shadow"
                            width="120"
                            height="120"
                            alt="{{ $user->name }}"
                            width="120"
                            height="120" />
                    </div>

                    <h4 class="mb-1">{{ $user->name }} {{ $user->surname }}</h4>
                    <p class="mb-0 text-secondary">{{ ucfirst($user->roles->pluck('name')->first() ?? 'Guest') }}</p>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
