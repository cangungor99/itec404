<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Club;

class ManagerClubController extends Controller
{
    public function show()
    {
        $managerID = Auth::id();

        $club = Club::where('managerID', $managerID)->firstOrFail();

        return view('manager.club.show', compact('club'));
    }
}
