@extends('layouts.app')
@section('title', 'Manage Budget')
@section('content')
<!--start content-->
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Club</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Budget Management</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#addBudgetModal"><i class="bi bi-plus-circle"></i> New Budget</button>
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#manageItemsModal"><i class="bi bi-pencil-square"></i> Manage Items</button>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
        <div class="col">
            <div class="card radius-10 shadow border-start border-0 border-4 border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-1 text-secondary">Total Budget</p>
                            <h4 class="mb-0">$12,500.00</h4>
                        </div>
                        <div class="ms-auto text-primary fs-1">
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 shadow border-start border-0 border-4 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-1 text-secondary">Planned Expenses</p>
                            <h4 class="mb-0">$9,300.00</h4>
                        </div>
                        <div class="ms-auto text-success fs-1">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 shadow border-start border-0 border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-1 text-secondary">Actual Expenses</p>
                            <h4 class="mb-0">$7,850.00</h4>
                        </div>
                        <div class="ms-auto text-warning fs-1">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 shadow border-start border-0 border-4 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-1 text-secondary">Remaining</p>
                            <h4 class="mb-0">$4,650.00</h4>
                        </div>
                        <div class="ms-auto text-danger fs-1">
                            <i class="bi bi-piggy-bank-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <!-- Charts -->
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card radius-10">
                <div class="card-body">
                    <h6 class="mb-3">Budget Distribution</h6>
                    <canvas id="budgetPieChart" height="220"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card radius-10">
                <div class="card-body">
                    <h6 class="mb-3">Planned vs Actual (per Category)</h6>
                    <canvas id="budgetBarChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Budget Modal -->
    <div class="modal fade" id="addBudgetModal" tabindex="-1" aria-labelledby="addBudgetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBudgetModalLabel">Add New Budget Period</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="periodStart" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="periodStart">
                        </div>
                        <div class="mb-3">
                            <label for="periodEnd" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="periodEnd">
                        </div>
                        <div class="mb-3">
                            <label for="totalAmount" class="form-label">Total Amount</label>
                            <input type="number" step="0.01" class="form-control" id="totalAmount">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Manage Items Modal -->
    <div class="modal fade" id="manageItemsModal" tabindex="-1" aria-labelledby="manageItemsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageItemsModalLabel">Manage Budget Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Planned</th>
                                <th>Actual</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Venue</td>
                                <td>$2,000</td>
                                <td>$1,800</td>
                                <td>Main hall booking</td>
                            </tr>
                            <tr>
                                <td>Marketing</td>
                                <td>$1,500</td>
                                <td>$1,200</td>
                                <td>Flyers and ads</td>
                            </tr>
                            <!-- More items dynamically here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>
<!--end content-->
@endsection
@push('scripts')
<script>
    // Budget Pie Chart
    const ctxPie = document.getElementById('budgetPieChart').getContext('2d');
    const budgetPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Planned', 'Actual', 'Remaining'],
            datasets: [{
                data: [9300, 7850, 4650],
                backgroundColor: ['#0d6efd', '#ffc107', '#dc3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Budget Bar Chart
    const ctxBar = document.getElementById('budgetBarChart').getContext('2d');
    const budgetBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Marketing', 'Equipment', 'Events', 'Travel'],
            datasets: [{
                    label: 'Planned',
                    data: [3000, 2500, 2800, 1000],
                    backgroundColor: '#198754'
                },
                {
                    label: 'Actual',
                    data: [2700, 2200, 2600, 350],
                    backgroundColor: '#ffc107'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
