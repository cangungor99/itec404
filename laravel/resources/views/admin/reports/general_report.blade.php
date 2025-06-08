@extends('layouts.app')
@section('title', 'General Report')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Pages</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">General Report</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

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
            <h5>Institution: Student Clubs Coordination Office</h5>
            <p>Generated On: June 7, 2025</p>

            <hr>

            <h6>1. Budget Summary</h6>
            <ul>
                <li>Total Annual Budget: <strong>$50,000</strong></li>
                <li>Used Budget (YTD): <strong>$32,740</strong></li>
                <li>Remaining Budget: <strong>$17,260</strong></li>
            </ul>

            <h6 class="mt-4">2. Members Overview</h6>
            <ul>
                <li>Total Registered Students: <strong>562</strong></li>
                <li>Average Members per Club: <strong>~23</strong></li>
                <li>Top Club by Membership: <strong>Tech Club (120 Members)</strong></li>
            </ul>

            <h6 class="mt-4">3. Events Summary</h6>
            <ul>
                <li>Total Events This Year: <strong>47</strong></li>
                <li>Most Active Club: <strong>Music Club (12 Events)</strong></li>
                <li>Upcoming Events (Next Month): <strong>5</strong></li>
            </ul>

            <h6 class="mt-4">4. Voting Activities</h6>
            <ul>
                <li>Total Votes Conducted: <strong>9</strong></li>
                <li>Average Voter Participation: <strong>68%</strong></li>
                <li>Most Recent Vote: <strong>Club Budget Allocation (May 2025)</strong></li>
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
