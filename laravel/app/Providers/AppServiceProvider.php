<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;

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
                $view->with('recentMessages', collect());
                return;
            }

            // NOTIFICATIONS
            if ($user->hasRole('admin')) {
                $notifications = Notification::latest()->take(5)->get();
            } else {
                $clubIds = $user->memberships->pluck('clubID');
                $notifications = Notification::whereIn('clubID', $clubIds)
                    ->latest()
                    ->take(5)
                    ->get();
            }

            $approvedClubIDs = $user->memberships->where('status', 'approved')->pluck('clubID')->values()->all();


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
            $view->with('recentMessages', $recentMessages);
        });
    }
}
