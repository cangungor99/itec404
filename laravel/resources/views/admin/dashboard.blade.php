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