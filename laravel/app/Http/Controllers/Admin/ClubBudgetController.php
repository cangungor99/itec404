<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class ClubBudgetController extends Controller
{
    public function index()
    {
        $clubs = Club::with('budget')->get();
        return view('admin.manage_budget', compact('clubs'));
    }
    public function update(Request $request, Club $club)
    {
        $data = $request->validate([
            'total_budget' => 'required|numeric|min:0',
            'budget_left' => 'required|numeric|min:0|max:' . $request->total_budget,
        ]);

        $budget = $club->budget;

        if ($budget) {
            // Güncelle
            $budget->update($data);
        } else {
            // Yoksa oluştur
            $club->budget()->create($data);
        }

        return redirect()->route('admin.budgets.index')
            ->with('success', 'Budget updated successfully.');
    }
}
