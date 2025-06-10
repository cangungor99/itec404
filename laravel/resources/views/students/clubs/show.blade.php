@extends('layouts.app')
@section('title', 'EMU Digital Club | Club Detail')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Clubs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('students.clubs.index') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Club Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card border shadow-none">
        <div class="card-header py-3">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-6">
                    <h5 class="mb-0">{{ $club->name }}</h5>
                </div>
            </div>
        </div>

        <div class="card-header py-2 bg-light">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">Club Logo</strong><br>
                        @if($club->photo)
                        <img src="{{ asset('storage/' . $club->photo) }}" alt="Club Logo" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                        <span>No logo</span>
                        @endif
                    </address>
                </div>
                <div class="col">
                    <address class="m-t-5 m-b-5">
                        <strong class="text-inverse">Club Description</strong><br>
                        {{ $club->description }}
                    </address>
                </div>
                <div class="col">
                    <small>Created At</small>
                    <div><b>{{ \Carbon\Carbon::parse($club->created_at)->format('F d, Y') }}</b></div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>CLUB COMMITTEE</th>
                            <th class="text-center" width="10%">ROLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Manager --}}
                        @if($club->manager)
                        <tr>
                            <td><span class="text-inverse">{{ $club->manager->name }}</span></td>
                            <td class="text-center">Manager</td>
                        </tr>
                        @endif

                        {{-- Leader --}}
                        @if($club->leader)
                        <tr>
                            <td><span class="text-inverse">{{ $club->leader->name }}</span></td>
                            <td class="text-center">Leader</td>
                        </tr>
                        @endif

                        {{-- Diğer yetkili üyeler (manager/leader hariç) --}}
                        @foreach($club->memberships as $membership)
                        @if(
                        $membership->role !== 'member' &&
                        $membership->userID !== $club->managerID &&
                        $membership->userID !== $club->leaderID
                        )
                        <tr>
                            <td><span class="text-inverse">{{ $membership->user->name }}</span></td>
                            <td class="text-center">{{ ucfirst($membership->role) }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>

                </table>
            </div>

            <hr>

            <!-- JOIN/LEAVE BUTTON -->
            <div class="my-3">
                @if($isMember && $membership?->status === 'pending')
                <p class="text-warning">* Your membership request is pending approval.</p>

                @elseif($isMember && $membership?->status === 'approved')
                <p class="text-success">* You are already an approved member of this club.</p>
                <form method="POST" action="{{ route('students.clubs.leave', $club->clubID) }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Leave Club</button>
                </form>

                @elseif($isMember && $membership?->status === 'rejected')
                <p class="text-danger">* Your membership request was rejected.</p>
                <form method="POST" action="{{ route('students.clubs.apply', $club->clubID) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Re-Apply</button>
                </form>

                @else
                <p>* If you joined that club do not need to click the button.</p>
                <form method="POST" action="{{ route('students.clubs.apply', $club->clubID) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Join Club</button>
                </form>
                @endif

            </div>
        </div>
    </div>
</main>
@endsection
