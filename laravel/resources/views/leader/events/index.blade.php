@extends('layouts.app')
@section('title', 'Club Events')
@php
$prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
@endphp
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Events</div>
        <div class="ms-auto">
            <a href="{{ route($prefix.'.events.create', $club->clubID) }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Create Event
            </a>
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($prefix.'.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event List</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-2">
        <h2 class="font-weight-light text-center text-muted py-3">Club Events for <span class="text-primary">{{ $club->name }}</span></h2>

        @forelse($events as $index => $event)
        <div class="row g-0 {{ $index % 2 === 0 ? '' : 'flex-row-reverse' }}">
            <div class="col-sm">
                <!--spacer-->
            </div>
            <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                <div class="row h-50">
                    <div class="col border-end">&nbsp;</div>
                    <div class="col">&nbsp;</div>
                </div>
                <h5 class="m-2">
                    <span class="badge rounded-pill bg-primary">{{ $index + 1 }}</span>
                </h5>
                <div class="row h-50">
                    <div class="col border-end">&nbsp;</div>
                    <div class="col">&nbsp;</div>
                </div>
            </div>

            <div class="col-sm py-2">
                <div class="card radius-15 {{ $index % 2 === 0 ? 'border-primary' : '' }}">
                    <div class="card-body">
                        <div class="float-end text-muted small">{{ \Carbon\Carbon::parse($event->start_time)->format('M d, Y H:i') }}</div>
                        <h4 class="card-title {{ $index % 2 === 0 ? 'text-primary' : '' }}">{{ $event->title }}</h4>
                        <p class="card-text">{{ $event->description }}</p>
                        @if($event->participants->count())
                        <div class="mt-3">
                            <p class="text-muted mb-1">
                                <i class="bi bi-people me-1"></i>
                                {{ $event->participants->count() }} participant(s)
                            </p>
                            <ul class="small ps-3 mb-0">
                                @foreach($event->participants->take(5) as $p)
                                <li>{{ $p->user->name }} {{ $p->user->surname }}</li>
                                @endforeach
                            </ul>

                            @if($event->participants->count() > 5)
                            <p class="text-muted small">+{{ $event->participants->count() - 5 }} more...</p>
                            @endif
                        </div>
                        @endif

                        <p><i class="bi bi-geo-alt me-1"></i>{{ $event->location }}</p>
                        <div class="mt-2">
                            <a href="{{ route($prefix.'.events.edit', [$club->clubID, $event->eventID]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form class="delete-event-form d-inline" data-title="{{ $event->title }}" action="{{ route($prefix.'.events.destroy', [$club->clubID, $event->eventID]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">No events found for this club.</p>
        @endforelse
    </div>
</main>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-event-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const title = form.getAttribute('data-title') || 'this event';

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${title}". This action cannot be undone.`,
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
