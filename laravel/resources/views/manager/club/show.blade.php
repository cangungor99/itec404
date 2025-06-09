@extends('layouts.app')
@section('title', 'Manage My Club')
@push('styles')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    .form-control, .form-select {
        border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(59, 125, 221, 0.25);
        border-color: #3b7ddd;
    }
    .club-image-preview {
        max-width: 120px;
        height: auto;
        border-radius: 8px;
    }
</style>
@endpush
@section('content')
<main class="page-content">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Manage Your Club</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('manager.club.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Club Name</label>
                                <input type="text" name="name" value="{{ old('name', $club->name) }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4" required>{{ old('description', $club->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Current Logo</label><br>
                                <img src="{{ asset('storage/' . $club->photo) }}" alt="Club Logo" class="club-image-preview">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Update Logo (Optional)</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
