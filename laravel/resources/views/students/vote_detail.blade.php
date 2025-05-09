@extends('layouts.app')
@section('title', 'Vote Detail')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Votes</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vote Results</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card text-center shadow border-0 result-card">
                <div class="card-body">
                    <h5 class="card-title">Club President Election</h5>
                    <p class="text-muted">Ended on: 2025-05-01</p>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="progress-ring" data-percentage="75">
                            <svg class="progress-ring__svg" width="120" height="120">
                                <circle class="progress-ring__circle--bg" cx="60" cy="60" r="50" />
                                <circle class="progress-ring__circle" cx="60" cy="60" r="50" />
                            </svg>
                            <div class="progress-ring__text">75%</div>
                        </div>
                    </div>
                    <p class="fw-bold text-success"><i class="bi bi-trophy-fill"></i> Winner: Option A</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center shadow border-0 result-card">
                <div class="card-body">
                    <h5 class="card-title">Event Theme Selection</h5>
                    <p class="text-muted">Ended on: 2025-04-20</p>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="progress-ring" data-percentage="35">
                            <svg class="progress-ring__svg" width="120" height="120">
                                <circle class="progress-ring__circle--bg" cx="60" cy="60" r="50" />
                                <circle class="progress-ring__circle" cx="60" cy="60" r="50" />
                            </svg>
                            <div class="progress-ring__text">35%</div>
                        </div>
                    </div>
                    <p class="fw-bold text-primary"><i class="bi bi-star-fill"></i> Winner: Theme Blue</p>
                </div>
            </div>
        </div>
    </div>
</main>
<!--end page main-->
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

                setTimeout(() => {
                    circle.style.strokeDashoffset = offset;
                }, 300);
            });
        </script>
@endpush
