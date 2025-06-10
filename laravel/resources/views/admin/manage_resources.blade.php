@extends('layouts.app')
@section('title', 'Resources')
@section('content')
<!--start content-->
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Resources</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-xl-3">
            <div class="card">
                <div class="card-body border-bottom">
                    <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Club Dropdown Eklendi -->
                        <div class="mb-3">
                            <label for="club" class="form-label">Choose Club</label>
                            <select class="form-control" id="club" name="clubID" required>
                                <option value="">Select a club</option>
                                @foreach ($clubs as $club)
                                <option value="{{ $club->clubID }}">{{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">File Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Choose File</label>
                            <input class="form-control" type="file" name="file" id="file" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success"><i class="bi bi-upload"></i> Upload Resource</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="mb-0">Uploaded Resources</h5>
                        <div class="ms-auto position-relative">
                            <form method="GET" action="{{ route('admin.resources.index') }}">
                                <div class="input-group">
                                    <select name="clubID" class="form-select" onchange="this.form.submit()">
                                        <option value="">Filter by Club</option>
                                        @foreach($clubs as $club)
                                        <option value="{{ $club->clubID }}" {{ request('clubID') == $club->clubID ? 'selected' : '' }}>
                                            {{ $club->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-secondary">Filter</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Created</th>
                                    <th>Related</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resources as $resource)
                                <tr>
                                    <td>
                                        {{-- Dosya tipine göre ikon --}}
                                        @php
                                        $ext = pathinfo($resource->file_path, PATHINFO_EXTENSION);
                                        $icon = match(strtolower($ext)) {
                                        'pdf' => 'bi bi-file-earmark-pdf text-danger',
                                        'doc', 'docx' => 'bi bi-file-earmark-word text-primary',
                                        'xls', 'xlsx' => 'bi bi-file-earmark-excel text-success',
                                        'jpg', 'jpeg', 'png', 'gif' => 'bi bi-file-earmark-image text-warning',
                                        'mp4', 'avi' => 'bi bi-film text-dark',
                                        default => 'bi bi-file-earmark',
                                        };
                                        @endphp
                                        <i class="{{ $icon }}"></i> {{ $resource->title }}
                                    </td>
                                    <td>{{ $resource->description }}</td>
                                    <td><a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank">Download</a></td>
                                    <td>{{ $resource->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $resource->club->name ?? 'N/A' }}</td>
                                    <td>
                                        <form action="{{ route('admin.resources.destroy', $resource->resourceID) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end page main-->
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
