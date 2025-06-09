@extends('layouts.app')
@section('title', 'Manage Resources')

@section('content')
<main class="page-content">
    <div class="card shadow-sm border-0 radius-10 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="mb-0">All Club Resources</h4>
            <form method="GET" action="{{ route('admin.resources.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by title or description" value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="club_id" class="form-select">
                        <option value="">-- Filter by Club --</option>
                        @foreach($clubs as $club)
                        <option value="{{ $club->clubID }}" {{ request('club_id') == $club->clubID ? 'selected' : '' }}>
                            {{ $club->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-outline-primary" type="submit">Apply Filters</button>
                    <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

        </div>
    </div>

    <div class="card shadow-sm border-0 radius-10">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Club</th>
                        <th>User</th>
                        <th>Description</th>
                        <th>Uploaded At</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resources as $resource)
                    <tr>
                        <td>{{ $resource->title }}</td>
                        <td>{{ $resource->club->name ?? 'N/A' }}</td>
                        <td>{{ $resource->user->name ?? 'N/A' }}</td>
                        <td>{{ $resource->description }}</td>
                        <td>{{ $resource->created_at ? $resource->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                View
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.resources.destroy', $resource->resourceID) }}" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No resources found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
