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


            if ($user->hasRole('admin')) {
                $notifications = Notification::latest()->take(5)->get();
            } else {
                $clubIds = $user->memberships->pluck('clubID');
                $notifications = Notification::whereIn('clubID', $clubIds)
                    ->latest()
                    ->take(5)
                    ->get();
            }


            $recentMessages = Chat::with(['sender', 'club'])
                ->where(function ($q) use ($user) {
                    $q->where('receiverID', $user->userID)
                        ->orWhere(function ($q2) use ($user) {
                            $q2->whereNull('receiverID')
                                ->whereHas('club.memberships', function ($m) use ($user) {
                                    $m->where('userID', $user->userID)
                                        ->where('status', 'approved');
                                });
                        });
                })
                ->latest('created_at')
                ->take(5)
                ->get();

            $view->with('notifications', $notifications);
            $view->with('recentMessages', $recentMessages);
        });
    }
}
