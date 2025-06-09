@extends('layouts.app')
@section('title', 'General Report')
@section('content')

<main class="page-content">

    <div class="card shadow-sm border-0 radius-10 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Club Report Overview</h4>
            <button class="btn btn-outline-primary" onclick="exportToPDF()">
                <i class="bi bi-file-earmark-pdf"></i> Export to PDF
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0 radius-10" id="reportContent">
        <div class="card-body">
            <h5>General Report for Your Club</h5>
            <p>Generated On: {{ now()->format('F j, Y - H:i') }}</p>
            <hr>

            <h6>1. Budget Summary</h6>
            <ul>
                <li>Total Budget: <strong>${{ number_format($totalBudget) }}</strong></li>
                <li>Used Budget: <strong>${{ number_format($usedBudget) }}</strong></li>
                <li>Remaining Budget: <strong>${{ number_format($remainingBudget) }}</strong></li>
            </ul>

            <h6 class="mt-4">2. Membership</h6>
            <ul>
                <li>Total Club Members: <strong>{{ $totalMembers }}</strong></li>
            </ul>

            <h6 class="mt-4">3. Events</h6>
            <ul>
                <li>Events This Year: <strong>{{ $totalEvents }}</strong></li>
                <li>Upcoming Events (Next Month): <strong>{{ $upcomingEvents }}</strong></li>
            </ul>

            <h6 class="mt-4">4. Voting</h6>
            <ul>
                <li>Total Votes Conducted: <strong>{{ $totalVotes }}</strong></li>
            </ul>
        </div>
    </div>

</main>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function exportToPDF() {
        const element = document.getElementById('reportContent');
        const options = {
            margin: 0.5,
            filename: 'Club_General_Report.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().from(element).set(options).save();
    }
</script>
@endpush
