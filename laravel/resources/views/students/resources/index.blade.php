<!-- Updated Club Resources Page -->
@extends('layouts.app')
@section('title', 'EMU Digital Club | Club Resources')
@push('styles')
<style>
    .list-group-item.active {
        background-color: #e9f2ff !important;
        color: #0d6efd !important;
        font-weight: 500;
        border: none;
    }

    .list-group-item.active i {
        color: #0d6efd !important;
    }
</style>
@endpush
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('students.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Club Resources</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-12 col-xl-3">
            <div class="card">
                <div class="fm-menu">
                    <div class="list-group list-group-flush m-3">
                        <a href="{{ route('students.resources.index') }}" class="list-group-item py-1 {{ request('type') == null ? 'active' : '' }}">
                            <i class='bx bx-folder me-2 text-primary'></i>All Files
                        </a>
                        <a href="?type=word" class="list-group-item py-1 {{ request('type') == 'word' ? 'active' : '' }}">
                            <i class='bi bi-file-earmark-break-fill me-2 text-info'></i>Documents
                        </a>
                        <a href="?type=image" class="list-group-item py-1 {{ request('type') == 'image' ? 'active' : '' }}">
                            <i class='bi bi-file-earmark-image-fill me-2 text-warning'></i>Images
                        </a>
                        <a href="?type=video" class="list-group-item py-1 {{ request('type') == 'video' ? 'active' : '' }}">
                            <i class='bi bi-camera-reels-fill me-2 text-primary'></i>Videos
                        </a>
                        <a href="?type=audio" class="list-group-item py-1 {{ request('type') == 'audio' ? 'active' : '' }}">
                            <i class='bi bi-play-btn-fill me-2 text-danger'></i>Audio
                        </a>
                        <a href="?type=zip" class="list-group-item py-1 {{ request('type') == 'zip' ? 'active' : '' }}">
                            <i class='bi bi-file-earmark-zip-fill me-2 text-dark'></i>Zip Files
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-12 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Shared Resources</h5>
                        <form class="d-flex align-items-center" id="filterForm">
                            <label for="clubID" class="me-2 mb-0">Club:</label>
                            <select name="clubID" id="clubID" class="form-select w-auto me-3">
                                <option value="">All Clubs</option>
                                @foreach ($userClubs as $club)
                                <option value="{{ $club->clubID }}" {{ $clubID == $club->clubID ? 'selected' : '' }}>
                                    {{ $club->name }}
                                </option>
                                @endforeach
                            </select>
                        </form>

                        <form class="d-flex" method="GET" id="searchForm">
                            <input type="text" name="search" id="searchInput" class="form-control me-2" value="{{ request('search') }}" placeholder="Search the files">
                            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Uploaded By</th>
                                    <th>Size</th>
                                    <th>Uploaded At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="resource-list-wrapper">
                                @include('students.resources.partials.resource-list', ['resources' => $resources])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const sidebarLinks = document.querySelectorAll('.list-group-item');
        const resourceListWrapper = document.getElementById('resource-list-wrapper');
        const clubSelect = document.getElementById('clubID');

        function fetchResources(params = {}) {
            const query = new URLSearchParams(params).toString();
            fetch(`{{ route('students.resources.search') }}?${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    resourceListWrapper.innerHTML = html;
                });
        }

        function triggerFetch() {
            const type = new URLSearchParams(window.location.search).get('type');
            const search = searchInput.value;
            const clubID = clubSelect.value;
            fetchResources({
                search,
                type,
                clubID
            });
        }

        searchInput.addEventListener('input', triggerFetch);
        clubSelect.addEventListener('change', triggerFetch);

        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const type = new URL(this.href).searchParams.get('type');
                const search = searchInput.value;
                const clubID = clubSelect.value;

                fetchResources({
                    type,
                    search,
                    clubID
                });

                sidebarLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endpush
