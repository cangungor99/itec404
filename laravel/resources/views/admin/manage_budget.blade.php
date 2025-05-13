@extends('layouts.app')

@section('title', 'Manage Budget')
@push('styles')
<style>
    .club-card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        transition: transform 0.3s ease;
        border-radius: 1rem;
    }

    .club-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    @media (max-width: 576px) {
        .club-card h5 {
            font-size: 1rem;
        }

        .club-card p {
            font-size: 0.9rem;
        }
    }
</style>
@endpush
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
                    <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="col-md-4 col-sm-6 mb-4">
        <div class="club-card shadow-sm p-4 rounded-4 animate__animated animate__fadeInUp">
            <div class="d-flex align-items-center mb-3">
                <img src="{{asset('assets/images/clubs/club1.png')}}" alt="Club Logo" class="me-3 rounded-circle border border-2" width="60" height="60">
                <div>
                    <h5 class="mb-0"><i class="bi bi-people-fill me-1 text-primary"></i> Club Name</h5>
                </div>
            </div>
            <p class="mb-1"><i class="bi bi-cash-coin text-success me-1"></i> <strong>Total Budget:</strong> 15,000₺</p>
            <p class="mb-3"><i class="bi bi-wallet2 text-warning me-1"></i> <strong>Budget Left:</strong> 7,500₺</p>
            <div class="text-end">
                <a href="manage_budget.php?club_id=1" class="btn btn-outline-primary btn-sm animate__animated animate__fadeIn animate__delay-1s">
                    <i class="bi bi-gear me-1"></i> Manage Budget
                </a>
            </div>
        </div>
    </div>


</main>
<!--end page main-->
@endsection
