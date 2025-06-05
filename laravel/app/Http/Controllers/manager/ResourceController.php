<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Club;

class ResourceController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        $club = Club::with('resources')->where('managerID', $manager->userID)->firstOrFail();

        return view('manager.resources.index', compact('club'));
    }
}
