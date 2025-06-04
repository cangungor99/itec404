<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClubMemberController extends Controller
{
    public function index(Club $club): View
    {
        $this->authorizeLeader($club);

        $memberships = Membership::where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->with('user')
            ->get();

        return view('leader.clubs.members.index', compact('club', 'memberships'));
    }

    protected function authorizeLeader(Club $club): void
    {
        if (Auth::id() !== $club->leaderID) {
            abort(403, 'You are not authorized to access this club.');
        }
    }

    public function destroy(Club $club, Membership $membership): RedirectResponse
    {
        $this->authorizeLeader($club);

        if ($membership->clubID !== $club->clubID) {
            abort(403, 'This membership does not belong to your club.');
        }

        $membership->delete();

        return back()->with('success', 'Member removed from the club.');
    }
}
