<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\ForumComment;
use App\Models\ClubEvent;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;
use Illuminate\Support\Facades\DB;



class StudentDashboardController extends Controller
{


    public function index()
    {
        $user = Auth::user();

        $clubIDs = $user->memberships()
            ->where('status', 'approved')
            ->pluck('clubID');

        $totalForums = Forum::whereIn('clubID', $clubIDs)->count();

        $totalPosts = ForumComment::whereIn('forumID', function ($query) use ($clubIDs) {
            $query->select('forumID')->from('forums')->whereIn('clubID', $clubIDs);
        })->count();

        $upcomingEvents = ClubEvent::whereIn('clubID', $clubIDs)
            ->where('start_time', '>=', now())
            ->count();

        $recentNotifications = DB::table('notification_user')
            ->join('notifications', 'notification_user.notificationID', '=', 'notifications.notificationID')
            ->leftJoin('clubs', 'notifications.clubID', '=', 'clubs.clubID')
            ->where('notification_user.userID', auth()->id())
            ->select(
                'notifications.title',
                'notifications.created_at',
                'notification_user.is_read',
                'clubs.name as club_name'
            )
            ->orderBy('notifications.created_at', 'desc')
            ->limit(5)
            ->get();

        $totalNotifications = $recentNotifications->count();

        $leaderClubs = $user->leadClubs()->get()->map(function ($club) {
            return [
                'club' => $club,
                'type' => 'leader'
            ];
        });

        $managerClubs = $user->manageClubs()->get()->map(function ($club) {
            return [
                'club' => $club,
                'type' => 'manager'
            ];
        });

        $memberClubs = $user->memberships()
            ->where('status', 'approved')
            ->with('club')
            ->get()
            ->map(function ($membership) {
                return [
                    'club' => $membership->club,
                    'type' => 'member'
                ];
            });


        $myClubRoles = collect($leaderClubs)
            ->merge($managerClubs)
            ->merge($memberClubs);

        return view('students.dashboard', compact(
            'totalForums',
            'totalPosts',
            'upcomingEvents',
            'recentNotifications',
            'totalNotifications',
            'leaderClubs',
            'myClubRoles'
        ));
    }
}
