<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Club;

class BudgetController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        $club = Club::with('budget')->where('managerID', $manager->userID)->firstOrFail();

        return view('manager.budget.index', compact('club'));
    }
}
