<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.navbar', function ($view) {
            $user = auth()->user();

            if (!$user) {
                $view->with('notifications', collect());
                $view->with('unreadNotificationIDs', []);
                $view->with('recentMessages', collect());
                return;
            }

            $approvedClubIDs = $user->memberships
                ->where('status', 'approved')
                ->pluck('clubID')
                ->values()
                ->all();

            // NOTIFICATIONS
            if ($user->hasRole('admin')) {
                $notifications = Notification::latest()->take(5)->get();
                $unreadIDs = [];
            } else {
                $clubIDs = $user->memberships->pluck('clubID');

                $notifications = Notification::whereIn('clubID', $clubIDs)
                    ->latest()
                    ->take(5)
                    ->get();

                $unreadIDs = $user->notificationsWithStatus()
                    ->wherePivot('is_read', false)
                    ->pluck('notifications.notificationID')
                    ->toArray();
            }

            // MESAJLAR
            $allMessages = Chat::with(['sender', 'club.memberships'])
                ->where(function ($q) use ($user, $approvedClubIDs) {
                    $q->where(function ($q1) use ($user) {
                        $q1->where('senderID', $user->userID)
                            ->orWhere('receiverID', $user->userID);
                    })->orWhere(function ($q2) use ($approvedClubIDs) {
                        $q2->whereNull('receiverID')
                            ->whereIn('clubID', $approvedClubIDs);
                    });
                })
                ->latest('created_at')
                ->get();

            $messagesMap = [];
            foreach ($allMessages as $msg) {
                if ($msg->clubID && !in_array($msg->clubID, $approvedClubIDs)) {
                    continue;
                }

                $key = $msg->clubID
                    ? 'club_' . $msg->clubID
                    : 'user_' . ($msg->senderID == $user->userID ? $msg->receiverID : $msg->senderID);

                if (!isset($messagesMap[$key])) {
                    $messagesMap[$key] = $msg;
                }
            }

            $recentMessages = collect(array_values($messagesMap))->take(5);

            $view->with('notifications', $notifications);
            $view->with('unreadNotificationIDs', $unreadIDs);
            $view->with('recentMessages', $recentMessages);
        });
    }
}
