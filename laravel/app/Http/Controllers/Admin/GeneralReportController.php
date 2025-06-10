<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Membership;
use App\Models\ClubBudget;
use App\Models\ClubEvent;
use App\Models\Vote;
use Carbon\Carbon;


class GeneralReportController extends Controller
{
    public function index(Request $request)
    {
        $clubID = $request->input('club_id');
        $clubs = Club::all();

        $budgetQuery = ClubBudget::query();
        if ($clubID) $budgetQuery->where('clubID', $clubID);
        $totalBudget = $budgetQuery->sum('total_budget');
        $remainingBudget = $budgetQuery->sum('budget_left');
        $usedBudget = $totalBudget - $remainingBudget;

        $memberQuery = Membership::query();
        if ($clubID) $memberQuery->where('clubID', $clubID);
        $totalMembers = $memberQuery->count();

        $avgMembers = Club::withCount('memberships')->get()->avg('memberships_count');
        $topClub = Club::withCount('memberships')->orderByDesc('memberships_count')->first();

        $eventQuery = ClubEvent::query();
        if ($clubID) $eventQuery->where('clubID', $clubID);
        $totalEvents = $eventQuery->whereYear('start_time', Carbon::now()->year)->count();
        $upcomingEvents = $eventQuery->whereMonth('start_time', Carbon::now()->addMonth()->month)->count();

        $topEventClub = Club::withCount('events')->orderByDesc('events_count')->first();

        $voteQuery = Vote::query();
        if ($clubID) $voteQuery->where('clubID', $clubID);
        $totalVotes = $voteQuery->count();
        $averageParticipation = 68;
        $lastVote = $voteQuery->with('voting')->orderByDesc('timestamp')->first();

        return view('admin.reports.general_report', compact(
            'totalBudget',
            'usedBudget',
            'remainingBudget',
            'totalMembers',
            'avgMembers',
            'topClub',
            'totalEvents',
            'upcomingEvents',
            'topEventClub',
            'totalVotes',
            'averageParticipation',
            'lastVote',
            'clubs'
        ));
    }
}
