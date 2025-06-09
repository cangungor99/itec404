<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Club;
use App\Models\Membership;

class ClubController extends Controller
{
    public function index(): View
    {
        $clubs = Club::where('status', 1)->get();
        return view('students.clubs.index', compact('clubs'));
    }

    public function show(Club $club)
    {

        $user = auth()->user();

        $membership = $user->memberships()
            ->where('clubID', $club->clubID)
            ->first();

        $isMember = $membership !== null;

        return view('students.clubs.show', compact('club', 'isMember', 'membership'));
    }

    public function apply(Club $club): RedirectResponse
    {
        $user = auth()->user();

        $membership = Membership::where('userID', $user->userID)
            ->where('clubID', $club->clubID)
            ->first();

        if (!$membership || $membership->status === 'rejected') {
            // Membership kaydı oluştur veya güncelle
            Membership::updateOrCreate(
                ['userID' => $user->userID, 'clubID' => $club->clubID],
                [
                    'role' => 'student',
                    'status' => 'pending',
                    'joined_at' => now(),
                ]
            );

            // Bildirimi oluştur
            $notification = \App\Models\Notification::create([
                'clubID'    => $club->clubID,
                'creatorID' => $user->userID,
                'title'     => 'New Club Membership Request',
                'content'   => "{$user->name} wants to join the club: {$club->name}",
            ]);

            // Bildirimi yetkililere gönder: leader + admin
            $leaderIDs = $club->memberships()
                ->where('role', 'leader')
                ->pluck('userID')
                ->toArray();

            $adminIDs = \App\Models\User::whereHas('roles', fn($q) => $q->where('name', 'admin'))
                ->pluck('userID')
                ->toArray();

            $notifiableIDs = array_unique(array_merge($leaderIDs, $adminIDs));
            $notification->readers()->attach($notifiableIDs, ['is_read' => false]);
        }

        return redirect()->route('students.clubs.show', $club->clubID)
            ->with('success', 'Your application has been sent and is pending approval.');
    }



    public function leave(Club $club): RedirectResponse
    {
        $user = auth()->user();

        Membership::where('userID', $user->userID)
            ->where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->delete();

        return redirect()->route('students.clubs.index')
            ->with('success', 'You have left the club.');
    }
}
