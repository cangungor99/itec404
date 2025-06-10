<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Membership;
use App\Models\ClubEvent;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Voting;

class LeaderDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $clubs = Club::where('leaderID', $user->userID)->get();
        $totalMembers = Membership::whereIn('clubID', $clubs->pluck('clubID'))
            ->where('status', 'approved')
            ->count();

        $pendingMembers = Membership::whereIn('clubID', $clubs->pluck('clubID'))
            ->where('status', 'pending')
            ->get();

        $upcomingEvents = ClubEvent::whereIn('clubID', $clubs->pluck('clubID'))
            ->where('start_time', '>', Carbon::now())
            ->count();

        $forumTopics = Forum::whereIn('clubID', $clubs->pluck('clubID'))->count();
        $recentEvents = ClubEvent::whereIn('clubID', $clubs->pluck('clubID'))
            ->orderBy('start_time', 'desc')
            ->take(5)
            ->get();

        $latestVoting = Voting::whereIn('clubID', $clubs->pluck('clubID'))
            ->with('options.votes')
            ->latest()
            ->first();
            $pollLabels = [];
            $pollData = [];
            $pollTitle = null;
            
            if ($latestVoting) {
                $pollTitle = $latestVoting->title; 
                foreach ($latestVoting->options as $option) {
                    $pollLabels[] = $option->option_text;
                    $pollData[] = $option->votes->count();
                }
            }
            

        return view('students.leader.dashboard', compact(
            'totalMembers',
            'pendingMembers',
            'upcomingEvents',
            'forumTopics',
            'recentEvents',
            'pollLabels',
            'pollData',
            'pollTitle',
        ));
    }
}
