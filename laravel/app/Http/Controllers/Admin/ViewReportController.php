<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Membership;
use App\Models\ClubBudget;
use App\Models\ClubEvent;

class ViewReportController extends Controller
{
    public function index()
    {
        $totalClubs = Club::count();
        $totalMembers = Membership::count();
        $budgetUsed = ClubBudget::sum('total_budget') - ClubBudget::sum('budget_left');
        $recentEvents = ClubEvent::with('club')->orderByDesc('start_time')->take(5)->get();

        return view('Admin.reports.view_reports', compact(
            'totalClubs',
            'totalMembers',
            'budgetUsed',
            'recentEvents'
        ));
    }
}
