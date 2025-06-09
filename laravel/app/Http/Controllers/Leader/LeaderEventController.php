<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\ClubEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LeaderEventController extends Controller
{
    protected function authorizeClubAccess(Club $club): void
    {
        $userID = auth()->user()->userID;

        if ($club->leaderID !== $userID && $club->managerID !== $userID) {
            abort(403, 'You are not authorized to access this club.');
        }
    }


    public function index(Club $club): View
    {
        $this->authorizeClubAccess($club);

        $events = $club->events()
            ->with(['participants.user'])
            ->latest('start_time')
            ->get();
        return view('leader.events.index', compact('club', 'events'));
    }

    public function create(Club $club): View
    {
        $this->authorizeClubAccess($club);
        return view('leader.events.create', compact('club'));
    }

    public function store(Request $request, Club $club): RedirectResponse
    {
        $this->authorizeClubAccess($club);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        ClubEvent::create([
            'clubID' => $club->clubID,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'created_at' => now(),
        ]);

        $prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';

        return redirect()->route($prefix . '.events.index', ['club' => $club->clubID])
            ->with('success', 'Event created successfully.');
    }

    public function edit(Club $club, ClubEvent $event): View
    {
        $this->authorizeClubAccess($club);
        return view('leader.events.edit', compact('club', 'event'));
    }

    public function update(Request $request, Club $club, ClubEvent $event): RedirectResponse
    {
        $this->authorizeClubAccess($club);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        $event->update($validated);

        return redirect()->route('leader.events.index', ['club' => $club->clubID])
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Club $club, ClubEvent $event): RedirectResponse
    {
        $this->authorizeClubAccess($club);
        $event->delete();

        return back()->with('success', 'Event deleted.');
    }
}
