@extends('layouts.app')
@section('title', 'Graphical Report')
@section('content')
<!--start content-->
<main class="page-content">

    <!--end breadcrumb-->
    <div class="d-flex justify-content-end mb-3">
    <button class="btn btn-sm btn-outline-success" onclick="exportChartsAsPDF()">Export All Charts as PDF</button>
</div>


    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body">
                    <h5 class="card-title text-center">Members per Club</h5>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body">
                    <h5 class="card-title text-center">Budget Usage Distribution</h5>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm border-0 radius-10">
                <div class="card-body">
                    <h5 class="card-title text-center">Monthly Event Count</h5>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


<script>
    // Controller'dan gelen veriler
    const membersPerClub = @json($membersPerClub);
    const budgetUsage = @json($budgetUsage);
    const monthlyEvents = @json($monthlyEvents);

    // === 1. Bar Chart: Üyeler / Kulüp ===
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: membersPerClub.map(item => item.name),
            datasets: [{
                label: 'Member Count',
                data: membersPerClub.map(item => item.memberships_count),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderWidth: 1
            }]
        }
    });

    // === 2. Doughnut Chart: Bütçe Kullanımı ===
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: budgetUsage.map(item => item.name),
            datasets: [{
                label: 'Used Budget',
                data: budgetUsage.map(item => item.used),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ]
            }]
        }
    });

    // === 3. Line Chart: Aylık Etkinlik Sayısı ===
    new Chart(document.getElementById('lineChart'), {
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
    const chartIds = ['barChart', 'doughnutChart', 'lineChart'];
    let y = 10;

    for (let i = 0; i < chartIds.length; i++) {
        const canvas = document.getElementById(chartIds[i]);

        if (!canvas) continue;

        const canvasImg = await html2canvas(canvas, {
            backgroundColor: '#ffffff'
        });

        const imgData = canvasImg.toDataURL('image/png');

        const imgWidth = 180;
        const imgHeight = (canvas.height / canvas.width) * imgWidth;

        if (i !== 0) doc.addPage();
        doc.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
    }

    doc.save('all_charts.pdf');
}

</script>
@endpush