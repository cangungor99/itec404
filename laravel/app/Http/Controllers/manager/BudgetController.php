<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Club;
use App\Models\ClubBudget;

class BudgetController extends Controller
{
    public function index()
    {
        $manager = Auth::user();
        $club = Club::with('budget')->where('managerID', $manager->userID)->firstOrFail();
        return view('manager.budget.index', compact('club'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'total_budget' => 'required|numeric|min:0',
        ]);

        $manager = Auth::user();
        $club = Club::where('managerID', $manager->userID)->firstOrFail();

        $budget = ClubBudget::firstOrNew(['clubID' => $club->clubID]);

        if (!$budget->exists) {
            $budget->budget_left = $request->total_budget;
        }

        $budget->total_budget = $request->total_budget;
        $budget->save();

        return back()->with('success', 'Budget updated successfully.');
    }
}
