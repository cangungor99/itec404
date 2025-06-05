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

        $recentNotifications = Notification::whereIn('clubID', $clubIDs)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $totalNotifications = $recentNotifications->count();

        // Leader olduğu kulüpler
        $leaderClubs = $user->leadClubs()->get()->map(function ($club) {
            return [
                'club' => $club,
                'type' => 'leader'
            ];
        });

        // Manager olduğu kulüpler
        $managerClubs = $user->manageClubs()->get()->map(function ($club) {
            return [
                'club' => $club,
                'type' => 'manager'
            ];
        });

        // Member olduğu kulüpler
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


        // Tüm roller birleştiriliyor
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
