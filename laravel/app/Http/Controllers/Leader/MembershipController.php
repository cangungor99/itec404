<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MembershipController extends Controller
{
    public function index(): View
    {
        $leader = Auth::user();

        // Sadece kendi kulüplerine gelen pending başvurular
        $pendingMemberships = Membership::where('status', 'pending')
            ->whereHas('club', function ($query) use ($leader) {
                $query->where('leaderID', $leader->userID);
            })
            ->with(['user', 'club'])
            ->get();

        return view('leader.memberships.index', compact('pendingMemberships'));
    }

    public function approve($id): RedirectResponse
    {
        $membership = Membership::findOrFail($id);
        $membership->status = 'approved';
        $membership->save();

        return back()->with('success', 'Membership approved.');
    }

    public function reject($id): RedirectResponse
    {
        $membership = Membership::findOrFail($id);
        $membership->status = 'rejected';
        $membership->save();

        return back()->with('success', 'Membership rejected.');
    }
}
