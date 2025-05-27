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

        // Öğrencinin üye olduğu kulüplerin ID'lerini al
        $clubIDs = $user->memberships()->pluck('clubID');

        // O kulüplere ait etkinlikleri getir
        $events = ClubEvent::whereIn('clubID', $clubIDs)
            ->with(['club', 'participants'])
            ->orderBy('start_time', 'asc')
            ->get();

        return view('students.events.index', compact('events'));
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
