<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use App\Models\ForumComment;
use App\Models\Attachment;
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

        $club = Club::where(function ($q) use ($userID) {
            $q->where('leaderID', $userID)
                ->orWhere('managerID', $userID);
        })->firstOrFail();

        $this->authorizeClubAccess($club);

        $pendingForums = Forum::with(['user', 'club', 'attachments'])
            ->where('clubID', $club->clubID)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $approvedForums = Forum::with(['user', 'club', 'attachments'])
            ->where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->latest()
            ->get();

        $pendingComments = ForumComment::with(['user', 'forum.club', 'attachments'])
            ->where('status', 'pending')
            ->whereHas('forum.club', fn($q) => $q->where('clubID', $club->clubID))
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
                $query->where('status', 'approved')->with([
                    'user',
                    'attachments',
                    'replies.user',
                    'replies.attachments',
                ]);
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
        $comment->attachments()->delete();
        $comment->delete();

        return back()->with('success', 'Comment rejected and deleted.');
    }

    public function comment(Request $request, Forum $forum)
    {
        $this->authorizeClubAccess($forum->club);
        $prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'parentID' => 'nullable|exists:forum_comments,commentID',
        ]);

        $comment = $forum->comments()->create([
            'userID' => auth()->id(),
            'message' => $validated['message'],
            'created_at' => now(),
            'parentID' => $validated['parentID'] ?? null,
            'status' => 'approved',
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('public/comment_attachments');
                Attachment::create([
                    'commentID' => $comment->commentID,
                    'userID' => auth()->id(),
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                    'uploaded_at' => now(),
                ]);
            }
        }

        return redirect()->route($prefix . '.forums.show', $forum->forumID)->with('success', 'Comment posted!');
    }
}
