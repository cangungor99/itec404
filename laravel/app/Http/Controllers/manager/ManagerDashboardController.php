<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Membership;
use App\Models\ClubBudget;
use App\Models\ClubEvent;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $manager = Auth::user();

        // Manager'ın yönettiği kulüpler
        $managedClubs = $manager->manageClubs;

        // Club ID'lerini al
        $clubIDs = $managedClubs->pluck('clubID');

        // Club üyeleri toplamı
        $totalMembers = Membership::whereIn('clubID', $clubIDs)->count();

        // Yaklaşan etkinlikler
        $upcomingEvents = ClubEvent::whereIn('clubID', $clubIDs)
            ->where('start_time', '>=', now())
            ->count();

        // Kullanılmış bütçe
        $usedBudget = ClubBudget::whereIn('clubID', $clubIDs)
            ->sum(DB::raw('total_budget - budget_left'));

        // Bekleyen üyelik istekleri
        $pendingRequests = Membership::whereIn('clubID', $clubIDs)
            ->where('status', 'pending')
            ->count();

        // En son 5 bildirim (notification_user ilişkisi üzerinden, okundu bilgisiyle birlikte)
        $recentNotifications = DB::table('notification_user')
            ->join('notifications', 'notification_user.notificationID', '=', 'notifications.notificationID')
            ->leftJoin('clubs', 'notifications.clubID', '=', 'clubs.clubID')
            ->where('notification_user.userID', $manager->userID)
            ->whereIn('notifications.clubID', $clubIDs)
            ->select(
                'notifications.title',
                'notifications.created_at',
                'notification_user.is_read',
                'clubs.name as club_name'
            )
            ->orderBy('notifications.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('manager.dashboard', compact(
            'totalMembers',
            'upcomingEvents',
            'usedBudget',
            'pendingRequests',
            'recentNotifications',
            'managedClubs'
        ));
    }
}
