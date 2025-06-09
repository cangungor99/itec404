@extends('layouts.app')
@section('title', 'Manage Votes')
@php
$prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
@endphp
@section('content')

<!--start content-->
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($prefix.'.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Votes</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card shadow-sm radius-10 border-0 mb-4 animate__animated animate__fadeIn">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-card-checklist text-primary me-2"></i> Manage Voting Sessions</h4>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($votings as $index => $voting)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $voting->title }}</td>
                            <td>{{ $voting->start_date }}</td>
                            <td>{{ $voting->end_date }}</td>
                            <td>
                                @if(now()->between($voting->start_date, $voting->end_date))
                                <span class="badge bg-success">Active</span>
                                @elseif(now()->lt($voting->start_date))
                                <span class="badge bg-warning text-dark">Upcoming</span>
                                @else
                                <span class="badge bg-secondary">Ended</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- Edit opsiyonu opsiyonel: gerekirse eklenir --}}
                                    <a href="{{ route($prefix.'.votes.edit', [$club->clubID, $voting->votingID]) }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <a href="{{ route($prefix.'.votes.results', [$club->clubID, $voting->votingID]) }}" class="btn btn-outline-info btn-sm"><i class="bi bi-bar-chart-line"></i></a>
                                    <form action="{{ route($prefix.'.votes.destroy', [$club->clubID, $voting->votingID]) }}" method="POST" class="delete-vote-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No votings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route($prefix.'.votes.create', $club->clubID) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> New Voting
                </a>
            </div>
        </div>
    </div>

</main>
<!--end page main-->
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-vote-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Formu hemen gönderme
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
