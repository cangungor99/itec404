<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function edit()
    {
        $managerID = Auth::id();
        $club = Club::where('managerID', $managerID)->firstOrFail();
        return view('manager.club.edit', compact('club'));
    }

    public function update(Request $request)
    {
        $managerID = Auth::id();
        $club = Club::where('managerID', $managerID)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('public/club_photos', $filename);
            $club->photo = 'storage/club_photos/' . $filename;
        }

        $club->name = $validated['name'];
        $club->description = $validated['description'] ?? $club->description;
        $club->save();

        return redirect()->route('manager.club.show')->with('success', 'Club updated successfully.');
    }
}

