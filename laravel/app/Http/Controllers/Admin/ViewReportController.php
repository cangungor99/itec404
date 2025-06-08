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
        // 1. Toplam kulüp sayısı
        $totalClubs = Club::count();

        // 2. Toplam üye sayısı
        $totalMembers = Membership::count();

        // 3. Aylık kullanılan bütçe (toplam - kalan)
        $budgetUsed = ClubBudget::sum('total_budget') - ClubBudget::sum('budget_left');

        // 4. Son etkinlikler (en yeni 5 tanesi)
        $recentEvents = ClubEvent::with('club')->orderByDesc('start_time')->take(5)->get();

        return view('admin.view_reports', compact(
            'totalClubs',
            'totalMembers',
            'budgetUsed',
            'recentEvents'
        ));
    }
}
