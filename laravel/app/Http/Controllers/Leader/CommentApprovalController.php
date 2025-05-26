<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ForumComment;

class CommentApprovalController extends Controller
{
    public function index()
    {
        $leaderID = Auth::id();

        $comments = ForumComment::where('status', 'pending')
            ->whereHas('forum.club', function ($query) use ($leaderID) {
                $query->where('leaderID', $leaderID);
            })
            ->with('user', 'forum.club')
            ->latest()
            ->get();

        return view('leader.comments.pending', compact('comments'));
    }

    public function approve(ForumComment $comment)
    {
        $this->authorizeLeader($comment);
        $comment->update(['status' => 'approved']);

        return back()->with('success', 'Comment approved.');
    }

    public function reject(ForumComment $comment)
    {
        $this->authorizeLeader($comment);
        $comment->delete();

        return back()->with('success', 'Comment rejected and deleted.');
    }

    protected function authorizeLeader(ForumComment $comment)
    {
        if (Auth::id() !== $comment->forum->club->leaderID) {
            abort(403);
        }
    }
}
