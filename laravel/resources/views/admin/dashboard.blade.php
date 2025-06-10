@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<!--start content-->
<main class="page-content">

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Clubs</p>
                            <h4>{{ $totalClubs }}</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end {{ $clubGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $clubGrowth >= 0 ? '+' : '' }}{{ $clubGrowth }}%
                                <i class="bi {{ $clubGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            </p>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Events</p>
                            <h4>{{ $totalEvents }}</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end {{ $eventGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $eventGrowth >= 0 ? '+' : '' }}{{ $eventGrowth }}%
                                <i class="bi {{ $eventGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            </p>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Budget</p>
                            <h4>${{ number_format($totalBudget / 1000, 1) }}K</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end {{ $budgetGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $budgetGrowth >= 0 ? '+' : '' }}{{ $budgetGrowth }}%
                                <i class="bi {{ $budgetGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            </p>
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card overflow-hidden radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                        <div class="w-50">
                            <p>Total Users</p>
                            <h4>{{ $totalUsers }}</h4>
                        </div>
                        <div class="w-50">
                            <p class="mb-3 float-end {{ $userGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $userGrowth >= 0 ? '+' : '' }}{{ $userGrowth }}%
                                <i class="bi {{ $userGrowth >= 0 ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                            </p>
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Budget Distribution</h6>
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">View All</a></li>
                                <li><a class="dropdown-item" href="#">Export</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="chart5"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Posts by Category</h6>
                        <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Posts</a></li>
                                <li><a class="dropdown-item" href="#">Statistics</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-3 mt-2 align-items-center">
                        <div class="col-lg-7 col-xl-7 col-xxl-8">
                            <div class="by-device-container">
                                <div class="piechart-legend">
                                    <h2 class="mb-1">74%</h2>
                                    <h6 class="mb-0">Most Active Category</h6>
                                </div>
                                <canvas id="chart6"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-5 col-xxl-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                                    <i class="bi bi-chat-dots-fill me-2 text-primary"></i> Forum - <span>54%</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                                    <i class="bi bi-calendar-event-fill me-2 text-success"></i> Events - <span>28%</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                                    <i class="bi bi-file-earmark-text-fill me-2 text-warning"></i> Docs - <span>18%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

</main>

<!--end page main-->
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        chart: {
            type: 'line',
            height: 50,
            sparkline: {
                enabled: true
            }
        },
        series: [{
            data: [10, 12, 14, 16, 18, 19, 20] 
        }],
        stroke: {
            curve: 'smooth',
            width: 2
        },
        colors: ['#28a745']
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();
</script>

<script>
    var budgetData = @json($budgetDistribution);

    var chartOptions = {
        series: budgetData.map(item => item.value),
        chart: {
            type: 'donut',
            height: 300
        },
        labels: budgetData.map(item => item.label),
        legend: {
            position: 'bottom'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: { width: 200 },
                legend: { position: 'bottom' }
            }
        }]
    };

    var chart5 = new ApexCharts(document.querySelector("#chart5"), chartOptions);
    chart5.render();
</script>
@endpush