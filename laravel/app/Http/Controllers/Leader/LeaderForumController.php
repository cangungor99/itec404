<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;
use Illuminate\Http\RedirectResponse;

class LeaderForumController extends Controller
{
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

    protected function authorizeLeader(Forum $forum)
    {
        if (Auth::id() !== $forum->club->leaderID) {
            abort(403);
        }
    }

    public function published()
    {
        $leaderID = Auth::id();

        $forums = Forum::where('status', 'approved')
            ->whereHas('club', function ($query) use ($leaderID) {
                $query->where('leaderID', $leaderID);
            })
            ->with('user', 'club')
            ->latest()
            ->get();

        return view('leader.forums.approved', compact('forums'));
    }

    public function destroy(Forum $forum): RedirectResponse
    {
        if (Auth::id() !== $forum->club->leaderID) {
            abort(403, 'You are not authorized to delete this forum.');
        }

        $forum->comments()->delete();
        $forum->attachments()->delete();
        $forum->delete();

        return back()->with('success', 'Forum and related content deleted successfully.');
    }
}
