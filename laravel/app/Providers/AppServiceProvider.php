<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

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
        // Navbar’ı render eden view’e notifications verisini paylaş
        View::composer('layouts.navbar', function ($view) {
            $user = auth()->user();
            if (! $user) {
                $view->with('notifications', collect());
                return;
            }

            // Admin ise tüm bildirimleri al, değilse üyesi olduğu kulüplerin bildirimlerini al
            if ($user->hasRole('admin')) {
                $notifications = Notification::latest()->take(5)->get();
            } else {
                $clubIds = $user->memberships->pluck('clubID');
                $notifications = Notification::whereIn('clubID', $clubIds)
                    ->latest()
                    ->take(5)
                    ->get();
            }

            $view->with('notifications', $notifications);
        });
    }
}
