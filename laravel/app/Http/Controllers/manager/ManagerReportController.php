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

        // Bütçe bilgileri
        $budget = $club->budget;
        $totalBudget = $budget?->total_budget ?? 0;
        $remainingBudget = $budget?->budget_left ?? 0;
        $usedBudget = $totalBudget - $remainingBudget;

        // Üyeler
        $totalMembers = $club->memberships()->count();

        // Etkinlikler
        $totalEvents = $club->events()
            ->whereYear('start_time', Carbon::now()->year)
            ->count();

        $upcomingEvents = $club->events()
            ->whereMonth('start_time', Carbon::now()->addMonth()->month)
            ->count();

        // Oylama
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
        $club = \App\Models\Club::where('managerID', auth()->id())->firstOrFail();

        // Üye sayısı
        $memberCount = $club->memberships()->count();

        // Bütçe kullanımı
        $usedBudget = $club->budget
            ? $club->budget->total_budget - $club->budget->budget_left
            : 0;

        // Aylık etkinlikler
        $monthlyEvents = $club->events()
            ->selectRaw('strftime("%Y-%m", start_time) as month, count(*) as count')
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
