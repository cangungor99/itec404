<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use Carbon\Carbon;

class ManagerReportController extends Controller
{
    public function general()
    {
        $club = Club::where('managerID', auth()->id())->firstOrFail();

        $budget = $club->budget;
        $totalBudget = $budget?->total_budget ?? 0;
        $remainingBudget = $budget?->budget_left ?? 0;
        $usedBudget = $totalBudget - $remainingBudget;

        $totalMembers = $club->memberships()->count();

        $totalEvents = $club->events()
            ->whereYear('start_time', Carbon::now()->year)
            ->count();

        $upcomingEvents = $club->events()
            ->whereMonth('start_time', Carbon::now()->addMonth()->month)
            ->count();

        $totalVotes = $club->votings()->withCount('votes')->get()->sum('votes_count');

        return view('manager.reports.general_report', compact(
            'totalBudget',
            'usedBudget',
            'remainingBudget',
            'totalMembers',
            'totalEvents',
            'upcomingEvents',
            'totalVotes'
        ));
    }

    public function graphical()
    {
        $club = Club::where('managerID', auth()->id())->firstOrFail();

        $memberCount = $club->memberships()->count();

        $usedBudget = $club->budget
            ? $club->budget->total_budget - $club->budget->budget_left
            : 0;

        $monthlyEvents = $club->events()
            ->selectRaw("DATE_FORMAT(start_time, '%Y-%m') as month, count(*) as count")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('manager.reports.graphical_report', compact(
            'memberCount',
            'usedBudget',
            'monthlyEvents',
            'club'
        ));
    }
}
