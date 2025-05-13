@extends('layouts.app')
@section('title', 'EMU Digital Club | Active Votes')
@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Club Votes</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Club Votes</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th><i class="bi bi-card-text me-1"></i> Title</th>
                        <th><i class="bi bi-info-circle me-1"></i> Description</th>
                        <th><i class="bi bi-calendar-event me-1"></i> Start Date</th>
                        <th><i class="bi bi-clock-history me-1"></i> End Date</th>
                        <th><i class="bi bi-calendar-check me-1"></i> Created At</th>
                        <th><i class="bi bi-lightbulb-fill me-1"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="vote-row" data-title="Club of the Year" data-description="This vote selects the best student club of the year." data-status="active">
                        <td>Club of the Year</td>
                        <td>This vote selects the best student club of the year.</td>
                        <td>2025-05-01 08:00</td>
                        <td>2025-05-10 23:59</td>
                        <td>2025-04-28 14:20</td>
                        <td><span class="badge bg-success">Active</span></td>
                    </tr>
                    <tr class="vote-row" data-title="Old Vote Example" data-description="This vote has already ended." data-status="inactive">
                        <td>Old Vote Example</td>
                        <td>This vote has already ended.</td>
                        <td>2025-04-01 09:00</td>
                        <td>2025-04-10 23:59</td>
                        <td>2025-03-28 11:15</td>
                        <td><span class="badge bg-danger">Inactive</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Voting Modal -->
<div class="modal fade" id="votingModal" tabindex="-1" aria-labelledby="votingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="votingModalLabel">Voting Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="votingModalBody">
                <!-- Dynamic content goes here -->
            </div>
        </div>
    </div>
</div>
<!--end page main-->
@section('content')
