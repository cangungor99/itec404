<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MembershipController extends Controller
{

    protected function authorizeClubAccessByMembership(Membership $membership): void
    {
        $userID = auth()->id();

        if ($membership->club->leaderID !== $userID && $membership->club->managerID !== $userID) {
            abort(403, 'You are not authorized to approve/reject this membership.');
        }
    }

    public function index(): View
    {
        $user = Auth::user();

        $pendingMemberships = Membership::where('status', 'pending')
            ->whereHas('club', function ($query) use ($user) {
                $query->where('leaderID', $user->userID)
                    ->orWhere('managerID', $user->userID);
            })
            ->with(['user', 'club'])
            ->get();

        return view('leader.memberships.index', compact('pendingMemberships'));
    }


    public function approve($id): RedirectResponse
    {
        $membership = Membership::with('club')->findOrFail($id);
        $this->authorizeClubAccessByMembership($membership);

        $membership->status = 'approved';
        $membership->save();

        return back()->with('success', 'Membership approved.');
    }

    public function reject($id): RedirectResponse
    {
        $membership = Membership::with('club')->findOrFail($id);
        $this->authorizeClubAccessByMembership($membership);

        $membership->status = 'rejected';
        $membership->save();

        return back()->with('success', 'Membership rejected.');
    }
}
