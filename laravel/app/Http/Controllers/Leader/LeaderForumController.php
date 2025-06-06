<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use App\Models\ForumComment;
use App\Models\Club;
use Illuminate\Http\RedirectResponse;

class LeaderForumController extends Controller
{

    protected function authorizeClubAccess($club): void
    {
        $userID = auth()->user()->userID;

        if ($club->leaderID !== $userID && $club->managerID !== $userID) {
            abort(403, 'You are not authorized to access this club.');
        }
    }

    public function manage()
    {
        $userID = auth()->user()->userID;

        $club = \App\Models\Club::where(function ($q) use ($userID) {
            $q->where('leaderID', $userID)
                ->orWhere('managerID', $userID);
        })->firstOrFail();

        $this->authorizeClubAccess($club);

        $pendingForums = Forum::with('user', 'club')
            ->where('clubID', $club->clubID)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $approvedForums = Forum::with('user', 'club')
            ->where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->latest()
            ->get();

        $pendingComments = ForumComment::where('status', 'pending')
            ->whereHas('forum.club', fn($q) => $q->where('clubID', $club->clubID))
            ->with('user', 'forum.club')
            ->latest()
            ->get();

        return view('leader.forums.manage', compact('pendingForums', 'approvedForums', 'pendingComments'));
    }

    public function show(Forum $forum)
    {
        $this->authorizeClubAccess($forum->club);

        $forum->load([
            'user',
            'club',
            'attachments',
            'comments' => function ($query) {
                $query->where('status', 'approved')->with('user', 'replies');
            }
        ]);

        return view('leader.forums.show', compact('forum'));
    }

    public function approve(Forum $forum)
    {
        $this->authorizeClubAccess($forum->club);
        $forum->update(['status' => 'approved']);

        return back()->with('success', 'Forum approved.');
    }

    public function reject(Forum $forum)
    {
        $this->authorizeClubAccess($forum->club);
        $forum->comments()->delete();
        $forum->attachments()->delete();
        $forum->delete();

        return back()->with('success', 'Forum rejected and deleted.');
    }

    public function approveComment(ForumComment $comment)
    {
        $this->authorizeClubAccess($comment->forum->club);
        $comment->update(['status' => 'approved']);

        return back()->with('success', 'Comment approved.');
    }

    public function rejectComment(ForumComment $comment)
    {
        $this->authorizeClubAccess($comment->forum->club);
        $comment->delete();

        return back()->with('success', 'Comment rejected and deleted.');
    }
}
