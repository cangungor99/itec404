@extends('layouts.app')
@section('title', 'EMU Digital Club | Leader Resource Management')

@section('content')
<!--start content-->
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('leader.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Club Resources</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-xl-3">
            <div class="card">

                <div class="card">
                    <div class="card-body border-bottom">
                        <form action="{{ route('leader.resources.store', $club->clubID) }}" method="POST" enctype="multipart/form-data">
                            @csrf

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
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-upload"></i> Upload Resource
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="fm-menu">
                    <div class="list-group list-group-flush m-3">
                        <span class="list-group-item py-1"><i class='bx bx-folder me-2 text-primary'></i><span>All Files ({{ $resources->count() }})</span></span>
                        <span class="list-group-item py-1"><i class='bi bi-file-earmark-break-fill me-2 text-info'></i><span>Documents</span></span>
                        <span class="list-group-item py-1"><i class='bi bi-file-earmark-image-fill me-2 text-warning'></i><span>Images</span></span>
                        <span class="list-group-item py-1"><i class='bi bi-camera-reels-fill me-2 text-primary'></i><span>Videos</span></span>
                    </div>
                </div>
            </div>
            <!-- İsteğe bağlı sağ panel metrikleri burada bırakıldı -->
        </div>

        <!-- Main Content -->
        <div class="col-12 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('leader.resources', $club->clubID) }}" class="btn btn-sm btn-outline-secondary {{ request('type') === null ? 'active' : '' }}">All</a>
                        <a href="{{ route('leader.resources', [$club->clubID, 'type' => 'word']) }}" class="btn btn-sm btn-outline-primary {{ request('type') === 'word' ? 'active' : '' }}">Word</a>
                        <a href="{{ route('leader.resources', [$club->clubID, 'type' => 'pdf']) }}" class="btn btn-sm btn-outline-danger {{ request('type') === 'pdf' ? 'active' : '' }}">PDF</a>
                        <a href="{{ route('leader.resources', [$club->clubID, 'type' => 'image']) }}" class="btn btn-sm btn-outline-warning {{ request('type') === 'image' ? 'active' : '' }}">Images</a>
                        <a href="{{ route('leader.resources', [$club->clubID, 'type' => 'video']) }}" class="btn btn-sm btn-outline-info {{ request('type') === 'video' ? 'active' : '' }}">Videos</a>
                        <a href="{{ route('leader.resources', [$club->clubID, 'type' => 'zip']) }}" class="btn btn-sm btn-outline-dark {{ request('type') === 'zip' ? 'active' : '' }}">ZIP</a>
                    </div>
                    <form method="GET" action="{{ route('leader.resources', $club->clubID) }}" class="mb-3 d-flex" role="search">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search resources...">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                    <h5 class="mb-3">Shared Resources ({{ $resources->count() }})</h5>

                    @if($resources->isEmpty())
                    <div class="alert alert-info">No resources shared for this club.</div>
                    @else
                    <div class="list-group">
                        @foreach($resources as $resource)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            @php
                            $ext = strtolower(pathinfo($resource->file_path, PATHINFO_EXTENSION));

                            $icon = match($ext) {
                            'pdf' => 'bi bi-file-earmark-pdf-fill text-danger',
                            'doc', 'docx' => 'bi bi-file-earmark-word-fill text-primary',
                            'jpg', 'jpeg', 'png', 'gif' => 'bi bi-file-earmark-image-fill text-warning',
                            'mp4', 'avi', 'mov' => 'bi bi-camera-reels-fill text-info',
                            'mp3', 'wav' => 'bi bi-music-note-beamed text-secondary',
                            'zip', 'rar' => 'bi bi-file-earmark-zip-fill text-dark',
                            default => 'bi bi-file-earmark-fill text-muted'
                            };
                            @endphp

                            <div class="d-flex align-items-center gap-2">
                                <i class="{{ $icon }} fs-5"></i>
                                <div>
                                    <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank">
                                        {{ $resource->title }}
                                    </a>
                                    <small class="text-muted">{{ $resource->description }}</small>
                                    <small class="text-muted">Uploaded at: {{ $resource->created_at->diffForHumans() }}</small>
                                    <small class="text-muted">Size: {{ number_format(Storage::disk('public')->size($resource->file_path)/1024, 2) }} KB</small>

                                </div>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <a href="{{ asset('storage/' . $resource->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                    View
                                </a>
                                <form action="{{ route('leader.resources.destroy', [$club->clubID, $resource->resourceID]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</main>



<!--end page main-->
@endsection
