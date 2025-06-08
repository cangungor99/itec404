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
        // $clubs = Club::where('status', 'active')->get();
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

    $exists = Membership::where('userID', $user->userID)
        ->where('clubID', $club->clubID)
        ->exists();

    if (!$exists) {
        // 1. Kulüp üyeliğini oluştur
        Membership::create([
            'userID' => $user->userID,
            'clubID' => $club->clubID,
            'role' => 'member',
            'status' => 'pending',
            'joined_at' => now(),
        ]);

        // 2. Bildirimi oluştur
        $notification = \App\Models\Notification::create([
            'clubID'    => $club->clubID,
            'creatorID' => $user->userID,
            'title'     => 'New Club Approvment Request',
            'content'   => "{$user->name}, {$club->name} want to join the club.",
        ]);

        // 3. Kulüp yetkililerini bul (lider veya admin)
        $leaderIDs = $club->memberships()
            ->whereIn('role', ['leader', 'admin'])
            ->pluck('userID')
            ->toArray();

        // 4. Bildirimi yetkililere ata
        $notification->readers()->attach($leaderIDs, ['is_read' => false]);
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
