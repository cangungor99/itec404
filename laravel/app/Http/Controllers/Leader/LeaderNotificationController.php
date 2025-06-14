<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;

class LeaderNotificationController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        $clubs = $user->leadClubs->merge($user->manageClubs);

        return view('leader.notifications.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'clubID' => 'required|exists:clubs,clubID',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $user = Auth::user();
        $authorizedClubIDs = $user->leadClubs->merge($user->manageClubs)->pluck('clubID');

        if (! $authorizedClubIDs->contains($request->clubID)) {
            abort(403, 'You do not have permission to send notifications to this club..');
        }

        $notification = Notification::create([
            'clubID'    => $request->clubID,
            'creatorID' => $user->userID,
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        $userIDs = Membership::where('clubID', $request->clubID)
            ->where('status', 'approved')
            ->pluck('userID');

        $notification->readers()->syncWithPivotValues($userIDs->toArray(), ['is_read' => false]);


        return redirect()->back()->with('success', 'The notification was sent successfully.');
    }
}
