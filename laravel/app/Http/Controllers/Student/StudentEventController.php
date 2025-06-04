<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ClubEvent;
use Illuminate\View\View;
use App\Models\EventParticipant;
use Illuminate\Http\RedirectResponse;

class StudentEventController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $selectedClubID = request()->get('club_id');

        $clubs = $user->memberships()->with('club')->get()->pluck('club');

        $eventsQuery = ClubEvent::whereIn('clubID', $clubs->pluck('clubID'))
            ->with(['club', 'participants']);

        if ($selectedClubID) {
            $eventsQuery->where('clubID', $selectedClubID);
        }

        $events = $eventsQuery->orderBy('start_time')->get();

        return view('students.events.index', compact('events', 'clubs', 'selectedClubID'));
    }



    public function join(ClubEvent $event): RedirectResponse
    {
        $userID = auth()->id();

        // Zaten katılmış mı kontrol
        $exists = EventParticipant::where('eventID', $event->eventID)
            ->where('userID', $userID)
            ->exists();

        if (!$exists) {
            EventParticipant::create([
                'eventID' => $event->eventID,
                'userID' => $userID,
                'joined_at' => now(),
            ]);
        }

        return back()->with('success', 'You have joined the event.');
    }

    public function leave(ClubEvent $event): RedirectResponse
    {
        $userID = auth()->id();

        EventParticipant::where('eventID', $event->eventID)
            ->where('userID', $userID)
            ->delete();

        return back()->with('success', 'You have left the event.');
    }
}
