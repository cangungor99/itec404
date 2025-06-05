<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;
use App\Models\ClubBudget;
use App\Models\ClubEvent;
use App\Models\ClubMember;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalClubs = Club::count();

        $lastMonthClubCount = Club::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $clubGrowth = $lastMonthClubCount > 0
            ? round((($totalClubs - $lastMonthClubCount) / $lastMonthClubCount) * 100, 1)
            : 0;



        $totalEvents = ClubEvent::count();
        $lastMonthEventCount = ClubEvent::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $eventGrowth = $lastMonthEventCount > 0
            ? round((($totalEvents - $lastMonthEventCount) / $lastMonthEventCount) * 100, 1)
            : 0;




        $totalBudget = ClubBudget::sum('total_budget');
        $lastMonthBudget = ClubBudget::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_budget');

        $budgetGrowth = $lastMonthBudget > 0
            ? round((($totalBudget - $lastMonthBudget) / $lastMonthBudget) * 100, 1)
            : 0;






        $totalUsers = User::count();
        $lastMonthUserCount = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        $userGrowth = $lastMonthUserCount > 0
            ? round((($totalUsers - $lastMonthUserCount) / $lastMonthUserCount) * 100, 1)
            : 0;

            $budgetDistribution = Club::with('budget')
    ->whereHas('budget')
    ->get()
    ->map(function ($club) {
        return [
            'label' => $club->name,
            'value' => $club->budget->total_budget,
        ];
    });


        return view('admin.dashboard', compact(
            'totalClubs',
            'clubGrowth',
            'totalEvents',
            'eventGrowth',
            'totalBudget',
            'budgetGrowth',
            'totalUsers',
            'userGrowth',
            'budgetDistribution'
        ));
    }
}
