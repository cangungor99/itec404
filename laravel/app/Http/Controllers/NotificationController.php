<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            $notifications = Notification::latest()->paginate(15);
        } else {
            $clubIds = $user->memberships()->pluck('clubID');
            $notifications = Notification::whereIn('clubID', $clubIds)
                ->latest()
                ->paginate(15);
        }

        foreach ($notifications as $notif) {
            $notif->creator_name = $notif->creator->name ?? null;
            $notif->club_name = $notif->club->name ?? null;

            $pivot = $notif->readers->where('userID', $user->userID)->first();
            $notif->is_read = $pivot ? $pivot->pivot->is_read : false;

            if ($notif->creator && $notif->creator->hasRole('admin')) {
                $notif->role = 'admin';
            } elseif ($notif->creator && $notif->creator->hasRole('leader')) {
                $notif->role = 'leader';
            } else {
                $notif->role = 'student';
            }
        }

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($notificationID)
    {
        $user = auth()->user();

        $exists = $user->notificationsWithStatus()
            ->wherePivot('notificationID', $notificationID)
            ->exists();

        if (!$exists) {
            $user->notificationsWithStatus()->attach($notificationID, ['is_read' => true]);
        } else {
            $user->notificationsWithStatus()
                ->updateExistingPivot($notificationID, ['is_read' => true]);
        }

        return response()->json(['status' => 'success']);
    }
}
