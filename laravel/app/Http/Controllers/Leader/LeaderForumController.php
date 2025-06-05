<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use App\Models\ForumComment;
use Illuminate\Http\RedirectResponse;

class LeaderForumController extends Controller
{
    public function manage()
    {
        $leaderID = auth()->id();
        $club = \App\Models\Club::where('leaderID', $leaderID)->firstOrFail();

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
            ->whereHas('forum.club', fn($q) => $q->where('leaderID', $leaderID))
            ->with('user', 'forum.club')
            ->latest()
            ->get();

        return view('leader.forums.manage', compact('pendingForums', 'approvedForums', 'pendingComments'));
    }

    public function show(Forum $forum)
    {
        $this->authorizeLeader($forum);

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
        $this->authorizeLeader($forum);
        $forum->update(['status' => 'approved']);

        return back()->with('success', 'Forum approved.');
    }

    public function reject(Forum $forum)
    {
        $this->authorizeLeader($forum);
        $forum->comments()->delete();
        $forum->attachments()->delete();
        $forum->delete();

        return back()->with('success', 'Forum rejected and deleted.');
    }

    public function approveComment(ForumComment $comment)
    {
        $this->authorizeLeader($comment);
        $comment->update(['status' => 'approved']);

        return back()->with('success', 'Comment approved.');
    }

    public function rejectComment(ForumComment $comment)
    {
        $this->authorizeLeader($comment);
        $comment->delete();

        return back()->with('success', 'Comment rejected and deleted.');
    }

    protected function authorizeLeader($model)
    {
        $club = $model instanceof Forum
            ? $model->club
            : ($model instanceof ForumComment ? $model->forum->club : null);

        if (!$club || Auth::id() !== $club->leaderID) {
            abort(403, 'Unauthorized');
        }
    }
}
