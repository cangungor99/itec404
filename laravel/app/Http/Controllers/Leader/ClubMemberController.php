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
    protected function isManager(Club $club): bool
    {
        return Auth::id() === $club->managerID;
    }

    protected function isLeader(Club $club): bool
    {
        return Auth::id() === $club->leaderID;
    }

    protected function canAccess(Club $club): bool
    {
        return $this->isLeader($club) || $this->isManager($club);
    }

    public function index(Club $club): View
    {
        if (!$this->canAccess($club)) {
            abort(403);
        }

        $memberships = Membership::where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->with('user')
            ->get()
            ->sortBy(function ($m) {
                // Rol önceliği: manager > leader > student
                return match ($m->role) {
                    'manager' => 1,
                    'leader'  => 2,
                    'student' => 3,
                    default   => 4,
                };
            })
            ->unique('userID') // Aynı user sadece bir kez
            ->values();

        $canManageRoles = $this->isManager($club);

        return view('leader.clubs.members.index', compact('club', 'memberships', 'canManageRoles'));
    }

    public function setLeader(Club $club, $userID): RedirectResponse
    {
        if (!$this->isManager($club)) {
            abort(403, 'Only manager can assign leader.');
        }

        $user = \App\Models\User::findOrFail($userID);

        $isMember = $club->memberships()
            ->where('userID', $userID)
            ->where('status', 'approved')
            ->exists();

        if (!$isMember) {
            return back()->withErrors('Selected user is not an approved club member.');
        }

        // 1. Club tablosunda lideri ata
        $club->leaderID = $userID;
        $club->save();

        // 2. Membership tablosuna leader rolü ekle (varsa güncelle)
        Membership::updateOrCreate(
            ['userID' => $userID, 'clubID' => $club->clubID, 'role' => 'leader'],
            ['status' => 'approved', 'joined_at' => now()]
        );

        // 3. role_user tablosuna 'leader' rolünü ekle (eğer yoksa)
        $leaderRoleID = \App\Models\Role::where('name', 'leader')->value('roleID');
        if ($leaderRoleID && !$user->roles->contains('roleID', $leaderRoleID)) {
            $user->roles()->attach($leaderRoleID);
        }

        return back()->with('success', 'New leader assigned successfully.');
    }


    public function destroy(Club $club, Membership $membership): RedirectResponse
    {
        if (!$this->isManager($club)) {
            abort(403, 'Only manager can remove members.');
        }

        if ($membership->clubID !== $club->clubID) {
            abort(403, 'This membership does not belong to your club.');
        }

        if ($club->leaderID === $membership->userID) {
            $club->leaderID = null;
            $club->save();
        }

        $membership->delete();

        return back()->with('success', 'Member removed from the club.');
    }
}
