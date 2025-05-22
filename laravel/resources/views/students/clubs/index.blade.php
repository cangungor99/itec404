@extends('layouts.app')
@section('title', 'EMU Digital Club | Club Lists')

@section('content')
<!--start content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Clubs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('students.clubs.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Clubs</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header py-3">
            <div class="row align-items-center m-0">
                <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                    <select class="form-select">
                        <option>All category</option>
                        <option>IT</option>
                        <option>Sport</option>
                    </select>
                </div>
                <div class="col-md-2 col-6">
                    <select class="form-select">
                        <option>Status</option>
                        <option>Active</option>
                        <option>Disabled</option>
                        <option>Show all</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if($clubs->isEmpty())
                <div class="alert alert-info">You are not a member of any clubs yet.</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Club Logo</th>
                                <th>Club Name</th>
                                <th>Club Description</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clubs as $club)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="productlist">
                                        <a class="d-flex align-items-center gap-2" href="{{ route('students.clubs.show', $club->clubID) }}">
                                            <div class="product-box">
                                                <img src="{{ asset('storage/' . $club->photo) }}" alt="{{ $club->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <h6 class="mb-0">{{ $club->name }}</h6>
                                    </td>
                                    <td>
                                        <span>{{ \Illuminate\Support\Str::limit($club->description, 60) }}</span>
                                    </td>
                                    <td><span>{{ \Carbon\Carbon::parse($club->created_at)->format('m-d-Y') }}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3 fs-6">
                                            <a href="{{ route('students.clubs.show', $club->clubID) }}" class="text-primary" title="View Detail">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Pagination placeholder --}}
            {{-- <nav class="float-end mt-4" aria-label="Page navigation">
                {{ $clubs->links() }}
            </nav> --}}
        </div>
    </div>
</main>
<!--end page main-->
@endsection
