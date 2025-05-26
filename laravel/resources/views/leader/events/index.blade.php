@extends('layouts.app')
@section('title', 'Club Events')
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Events</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('leader.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event List</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-2">
        <h2 class="font-weight-light text-center text-muted py-3">Club Events for <span class="text-primary">{{ $club->name }}</span></h2>

        @forelse($events as $index => $event)
        <div class="row g-0 {{ $index % 2 === 0 ? '' : 'flex-row-reverse' }}">
            <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                <div class="row h-50">
                    <div class="col border-end">&nbsp;</div>
                    <div class="col">&nbsp;</div>
                </div>
                <h5 class="m-2">
                    <span class="badge rounded-pill bg-{{ $index % 2 === 0 ? 'primary' : 'light' }}">{{ $index + 1 }}</span>
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
                            <a href="{{ route('leader.events.edit', [$club->clubID, $event->eventID]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('leader.events.destroy', [$club->clubID, $event->eventID]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
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
