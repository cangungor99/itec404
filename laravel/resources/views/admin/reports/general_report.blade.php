@extends('layouts.app')
@section('title', 'General Report')
@section('content')
<main class="page-content">



    <div class="card shadow-sm border-0 radius-10 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="mb-0">General Report Overview</h4>
            <button class="btn btn-outline-primary" onclick="exportToPDF()">
                <i class="bi bi-file-earmark-pdf"></i> Export to PDF
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0 radius-10" id="reportContent">
        <div class="card-body">
            <h5>General Report: EMU Digital Club Report</h5>
            <p>Generated On: {{ \Carbon\Carbon::now()->format('F j, Y - H:i') }}</p>


            <hr>

            <h6>1. Budget Summary</h6>
            <ul>
                <li>Total Annual Budget: <strong>${{ number_format($totalBudget) }}</strong></li>
                <li>Used Budget (YTD): <strong>${{ number_format($usedBudget) }}</strong></li>
                <li>Remaining Budget: <strong>${{ number_format($remainingBudget) }}</strong></li>
            </ul>

            <h6 class="mt-4">2. Members Overview</h6>
            <ul>
                <li>Total Registered Students: <strong>{{ $totalMembers }}</strong></li>
                <li>Average Members per Club: <strong>~{{ $avgMembers }}</strong></li>
                <li>Top Club by Membership:
                    <strong>{{ $topClub->name }} ({{ $topClub->memberships_count }} Members)</strong>
                </li>
            </ul>

            <h6 class="mt-4">3. Events Summary</h6>
            <ul>
                <li>Total Events This Year: <strong>{{ $totalEvents }}</strong></li>
                <li>Most Active Club:
                    <strong>{{ $topEventClub->name }} ({{ $topEventClub->events_count }} Events)</strong>
                </li>
                <li>Upcoming Events (Next Month): <strong>{{ $upcomingEvents }}</strong></li>
            </ul>

            <h6 class="mt-4">4. Voting Activities</h6>
            <ul>
                <li>Total Votes Conducted: <strong>{{ $totalVotes }}</strong></li>
                <li>Average Voter Participation: <strong>{{ $averageParticipation }}%</strong></li>
                <li>Most Recent Vote:
                    <strong>
                        {{ $lastVote && $lastVote->voting ? $lastVote->voting->title : 'N/A' }}
                        ({{ $lastVote ? \Carbon\Carbon::parse($lastVote->timestamp)->format('F Y') : '' }})
                    </strong>
                </li>
            </ul>
        </div>
    </div>


</main>
<!--end page main-->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function exportToPDF() {
        const element = document.getElementById('reportContent');
        const options = {
            margin: 0.5,
            filename: 'General_Report_2025.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        html2pdf().from(element).set(options).save();
    }
</script>
@endpush