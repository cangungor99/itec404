@extends('layouts.app')
@section('title', 'My Club Events')
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Events</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('students.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">My Club Events</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-2">
        <div class="row mb-3 justify-content-end">
            <div class="col-md-4">
                <form method="GET" action="{{ route('students.events.index') }}">
                    <select name="club_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Clubs</option>
                        @foreach($clubs as $club)
                        <option value="{{ $club->clubID }}" {{ isset($selectedClubID) && $selectedClubID == $club->clubID ? 'selected' : '' }}>
                            {{ $club->name }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <h2 class="font-weight-light text-center text-muted py-3">Events from Your Clubs</h2>

        @forelse($events as $index => $event)
        <div class="row g-0 {{ $index % 2 === 0 ? '' : 'flex-row-reverse' }}">
            <div class="col-sm">
                <!--spacer-->
            </div>
            <!-- timeline vertical line & badge -->
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

            <!-- event card -->
            <div class="col-sm py-2">
                <div class="card radius-15 {{ $index % 2 === 0 ? 'border-primary' : '' }}">
                    <div class="card-body">
                        <div class="float-end text-muted small">
                            {{ \Carbon\Carbon::parse($event->start_time)->format('M d, Y H:i') }}
                        </div>
                        <h4 class="card-title {{ $index % 2 === 0 ? 'text-primary' : '' }}">{{ $event->title }}</h4>
                        <p class="mb-1"><strong>Club:</strong> {{ $event->club->name }}</p>
                        <p class="mb-1"><i class="bi bi-geo-alt me-1"></i>{{ $event->location }}</p>
                        <p class="card-text">{{ $event->description }}</p>

                        @php
                        $joined = $event->participants->contains('userID', auth()->id());
                        @endphp

                        <form action="{{ $joined
                                ? route('students.events.leave', $event->eventID)
                                : route('students.events.join', $event->eventID)
                            }}" method="POST" class="mt-3">
                            @csrf
                            <button class="btn btn-sm {{ $joined ? 'btn-danger' : 'btn-success' }}">
                                <i class="bi {{ $joined ? 'bi-x-circle' : 'bi-check-circle' }} me-1"></i>
                                {{ $joined ? 'Leave Event' : 'Join Event' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">You don't have any upcoming club events.</p>
        @endforelse
    </div>
</main>
@endsection
