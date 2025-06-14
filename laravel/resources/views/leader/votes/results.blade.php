@extends('layouts.app')
@section('title', 'Vote Detail')
@php
    $prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
@endphp
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Votes</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($prefix.'.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vote Results</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @php
            $maxVotes = $options->max('votes_count');
        @endphp

        @foreach($options as $option)
            @php
                $count = $option->votes_count;
                $percent = $totalVotes > 0 ? round(($count / $totalVotes) * 100) : 0;
                $isWinner = $count === $maxVotes && $totalVotes > 0;
            @endphp

            <div class="col">
                <div class="card text-center shadow border-0 result-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $voting->title }}</h5>
                        <p class="text-muted">Ended on: {{ \Carbon\Carbon::parse($voting->end_date)->format('Y-m-d') }}</p>
                        <div class="d-flex justify-content-center mb-3">
                            <div class="progress-ring" data-percentage="{{ $percent }}">
                                <svg class="progress-ring__svg" width="120" height="120">
                                    <circle class="progress-ring__circle--bg" cx="60" cy="60" r="50" />
                                    <circle class="progress-ring__circle" cx="60" cy="60" r="50" />
                                </svg>
                                <div class="progress-ring__text">{{ $percent }}%</div>
                            </div>
                        </div>

                        <p class="fw-bold {{ $isWinner ? 'text-success' : 'text-primary' }}">
                            <i class="bi {{ $isWinner ? 'bi-trophy-fill' : 'bi-star-fill' }}"></i>
                            {{ $isWinner ? 'Winner' : 'Option' }}: {{ $option->option_text }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.progress-ring').forEach(ring => {
        const percentage = parseFloat(ring.getAttribute('data-percentage'));
        const circle = ring.querySelector('.progress-ring__circle');
        const radius = circle.r.baseVal.value;
        const circumference = 2 * Math.PI * radius;
        const offset = circumference - (percentage / 100) * circumference;

        circle.style.strokeDasharray = `${circumference} ${circumference}`;
        circle.style.strokeDashoffset = circumference;
        circle.style.stroke = "#0d6efd";
        circle.style.strokeWidth = "8";
        circle.style.fill = "transparent";
        circle.style.transition = "stroke-dashoffset 1s ease-out";

        setTimeout(() => {
            circle.style.strokeDashoffset = offset;
        }, 300);
    });
</script>
@endpush
