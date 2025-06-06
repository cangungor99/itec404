@extends('layouts.app')
@section('title', 'View Report and Analytics')

@section('content')
<main class="page-content">
    <div class="container py-4">
        <h2 class="text-center mb-4">Report & Analytics Overview</h2>

        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Total Clubs</h5>
                        <h3>24</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Total Members</h5>
                        <h3>562</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>Monthly Budget Used</h5>
                        <h3>$12,340</h3>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-5">Recent Club Activities</h4>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Club</th>
                    <th>Activity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tech Club</td>
                    <td>Organized Hackathon</td>
                    <td>2025-06-05</td>
                </tr>
                <tr>
                    <td>Music Club</td>
                    <td>Held Music Fest</td>
                    <td>2025-06-01</td>
                </tr>
                <tr>
                    <td>Art Club</td>
                    <td>Exhibition Setup</td>
                    <td>2025-05-28</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
@endsection
