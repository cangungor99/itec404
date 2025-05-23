<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;

class ForumApprovalController extends Controller
{
    public function index()
    {
        $leaderID = Auth::id();

        $forums = Forum::where('status', 'pending')
            ->whereHas('club', function ($q) use ($leaderID) {
                $q->where('leaderID', $leaderID);
            })
            ->with('user', 'club')
            ->latest()
            ->get();

        return view('leader.forums.pending', compact('forums'));
    }

    public function approve(Forum $forum)
    {
        $this->authorizeLeader($forum);
        $forum->update(['status' => 'approved']);

        return back()->with('success', 'Forum approved successfully.');
    }

    public function reject(Forum $forum)
    {
        $this->authorizeLeader($forum);
        $forum->delete();

        return back()->with('success', 'Forum rejected and deleted.');
    }

    protected function authorizeLeader(Forum $forum)
    {
        if (Auth::id() !== $forum->club->leaderID) {
            abort(403);
        }
    }
}
