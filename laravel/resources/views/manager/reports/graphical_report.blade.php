@extends('layouts.app')
@section('title', 'Graphical Report')
@section('content')

<main class="page-content">
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-sm btn-outline-success" onclick="exportChartsAsPDF()">
            Export All Charts as PDF
        </button>
    </div>

    <div class="row">
        <!-- Üye Sayısı -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body text-center">
                    <h5>Member Count for {{ $club->name }}</h5>
                    <canvas id="memberChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bütçe Kullanımı -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body text-center">
                    <h5>Budget Usage</h5>
                    <canvas id="budgetChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Aylık Etkinlik -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body text-center">
                    <h5>Monthly Events</h5>
                    <canvas id="eventChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>
    const memberCount = {{ $memberCount }};
    const budgetUsed = {{ $usedBudget }};
    const monthlyEvents = @json($monthlyEvents);

    // Member chart (bar)
    new Chart(document.getElementById('memberChart'), {
        type: 'bar',
        data: {
            labels: ['{{ $club->name }}'],
            datasets: [{
                label: 'Members',
                data: [memberCount],
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        }
    });

    // Budget chart (doughnut)
    new Chart(document.getElementById('budgetChart'), {
        type: 'doughnut',
        data: {
            labels: ['Used Budget', 'Remaining Budget'],
            datasets: [{
                data: [budgetUsed, {{ $club->budget->budget_left ?? 0 }}],
                backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(75, 192, 192, 0.6)']
            }]
        }
    });

    // Monthly event chart (line)
    new Chart(document.getElementById('eventChart'), {
        type: 'line',
        data: {
            labels: monthlyEvents.map(item => item.month),
            datasets: [{
                label: 'Event Count',
                data: monthlyEvents.map(item => item.count),
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.3
            }]
        }
    });

    async function exportChartsAsPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        const chartIds = ['memberChart', 'budgetChart', 'eventChart'];

        for (let i = 0; i < chartIds.length; i++) {
            const canvas = document.getElementById(chartIds[i]);
            const canvasImg = await html2canvas(canvas);
            const imgData = canvasImg.toDataURL('image/png');
            const imgWidth = 180;
            const imgHeight = (canvas.height / canvas.width) * imgWidth;

            if (i !== 0) doc.addPage();
            doc.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
        }

        doc.save('Manager_Club_Charts.pdf');
    }
</script>
@endpush
