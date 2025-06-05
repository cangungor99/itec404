<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Admin: tüm bildirimler, değilse kullanıcının kulüp bildirimleri
        if ($user->hasRole('admin')) {
            $notifications = Notification::latest()->paginate(15);
        } else {
            $clubIds = $user->memberships->pluck('clubID');
            $notifications = Notification::whereIn('clubID', $clubIds)
                ->latest()
                ->paginate(15);
        }

        foreach ($notifications as $notif) {
            $user->notificationsWithStatus()->syncWithoutDetaching([
                $notif->notificationID => ['is_read' => true]
            ]);
        }


        return view('notifications.index', compact('notifications'));
    }
}
