@extends('layouts.app')

@section('title', 'Membership Requests')

@section('content')
<main class="page-content">
    <div class="container py-4">
        <h2>Pending Membership Requests</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($pendingMemberships->isEmpty())
            <div class="alert alert-info">No pending requests.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Club</th>
                        <th>User</th>
                        <th>Student No</th>
                        <th>Requested At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingMemberships as $membership)
                        <tr>
                            <td>{{ $membership->club->name }}</td>
                            <td>{{ $membership->user->name }}</td>
                            <td>{{ $membership->user->std_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($membership->joined_at)->format('F j, Y H:i') }}</td>
                            <td>
                                <form method="POST" action="{{ route('leader.memberships.approve', $membership->membershipID) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('leader.memberships.reject', $membership->membershipID) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>
@endsection
