<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\ClubBudget;
use App\Models\ClubEvent;
use Carbon\Carbon;


class GraphicalReportController extends Controller
{
    public function index()
    {
        // 1. Her kulübün üye sayısı
        $membersPerClub = Club::withCount('memberships')->get(['clubID', 'name']);

        // 2. Bütçe kullanımı (her kulüp için)
        $budgetUsage = Club::with('budget')->get()->map(function ($club) {
            return [
                'name' => $club->name,
                'used' => $club->budget
                    ? $club->budget->total_budget - $club->budget->budget_left
                    : 0,
            ];
        });

        // 3. Aylık etkinlik sayıları
        $monthlyEvents = ClubEvent::selectRaw('DATE_FORMAT(start_time, "%Y-%m") as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.reports.graphical_report', compact(
            'membersPerClub',
            'budgetUsage',
            'monthlyEvents'
        ));
    }
}
