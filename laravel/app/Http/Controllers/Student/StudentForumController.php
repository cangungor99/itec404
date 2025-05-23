<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;

class StudentForumController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $clubIDs = $user->memberships()->pluck('clubID');

        $forums = Forum::whereIn('clubID', $clubIDs)
            ->where('status', 'approved') // ✅ sadece onaylı olanlar
            ->with('user', 'club')
            ->latest()
            ->get();

        // ✅ Katıldığı kulüplerin bilgilerini ekle
        $clubs = $user->memberships()->with('club')->get()->pluck('club', 'clubID');

        return view('students.forums.index', compact('forums', 'clubs'));
    }

    public function create()
    {
        $clubs = Auth::user()->memberships()->with('club')->get()->pluck('club', 'clubID');
        return view('students.forums.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'clubID' => 'required|exists:clubs,clubID',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Forum::create([
            'clubID' => $validated['clubID'],
            'userID' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'pending',
            'created_at' => now(),
        ]);

        return redirect()->route('students.forums.index')->with('success', 'Forum created successfully.');
    }

    public function show(Forum $forum)
    {
        $forum->load([
            'user',
            'club',
            'attachments',
            'comments' => function ($q) {
                $q->where('status', 'approved')->with('user', 'replies');
            }
        ]);
        return view('students.forums.show', compact('forum'));
    }
    public function comment(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'parentID' => 'nullable|exists:forum_comments,commentID',
        ]);

        $forum->comments()->create([
            'userID' => Auth::id(),
            'message' => $validated['message'],
            'created_at' => now(),
            'parentID' => $validated['parentID'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('students.forums.show', $forum->forumID)->with('success', 'Comment posted!');
    }
}
