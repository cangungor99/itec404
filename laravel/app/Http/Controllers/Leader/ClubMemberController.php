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

    protected function authorizeClubAccess(Club $club): void
    {
        $userID = Auth::id();

        if ($club->leaderID !== $userID && $club->managerID !== $userID) {
            abort(403, 'You are not authorized to access this club.');
        }
    }


    public function index(Club $club): View
    {
        $this->authorizeClubAccess($club);

        $memberships = Membership::where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->with('user')
            ->get();

        $canManageRoles = $club->managerID === Auth::id();

        return view('leader.clubs.members.index', compact('club', 'memberships', 'canManageRoles'));
    }


    public function setLeader(Club $club, $userID): RedirectResponse
    {
        if (Auth::id() !== $club->managerID) {
            abort(403, 'Only manager can assign leader.');
        }

        $isMember = $club->memberships()
            ->where('userID', $userID)
            ->where('status', 'approved')
            ->exists();

        if (!$isMember) {
            return back()->withErrors('Selected user is not an approved club member.');
        }

        $club->leaderID = $userID;
        $club->save();

        return back()->with('success', 'New leader assigned successfully.');
    }



    public function destroy(Club $club, Membership $membership): RedirectResponse
    {
        $this->authorizeClubAccess($club);

        if ($membership->clubID !== $club->clubID) {
            abort(403, 'This membership does not belong to your club.');
        }

        $membership->delete();

        return back()->with('success', 'Member removed from the club.');
    }
}
