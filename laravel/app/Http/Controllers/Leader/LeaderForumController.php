<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;

class LeaderForumController extends Controller
{
    public function show(Forum $forum)
    {
        // Lider yetkisi kontrolü
        $this->authorizeLeader($forum);

        // Forum + ilişkili kullanıcı, kulüp, yorumlar
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
}
