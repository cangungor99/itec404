<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Club;
use App\Models\Attachment;
use App\Models\ForumComment;
use Illuminate\Support\Facades\Auth;

class StudentForumController extends Controller
{
    protected function ensureApprovedMemberOfClub($clubID)
    {
        $user = auth()->user();

        $isMember = $user->memberships()
            ->where('clubID', $clubID)
            ->where('status', 'approved')
            ->exists();

        if (! $isMember) {
            abort(403, 'You are not an approved member of this club.');
        }
    }

    public function index()
    {
        $user = Auth::user();

        $approvedMemberships = $user->memberships()
            ->where('status', 'approved')
            ->with('club')
            ->get();

        $clubIDs = $approvedMemberships->pluck('clubID');

        $clubs = $approvedMemberships->pluck('club', 'clubID');

        $forums = Forum::whereIn('clubID', $clubIDs)
            ->where('status', 'approved')
            ->with('user', 'club')
            ->latest()
            ->get();

        return view('students.forums.index', compact('forums', 'clubs'));
    }


    public function create()
    {
        $clubs = Auth::user()->memberships()
            ->where('status', 'approved')
            ->with('club')
            ->get()
            ->pluck('club', 'clubID');

        return view('students.forums.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'clubID' => 'required|exists:clubs,clubID',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->ensureApprovedMemberOfClub($validated['clubID']);

        $forum = Forum::create([
            'clubID' => $validated['clubID'],
            'userID' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'pending',
            'created_at' => now(),
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('public/forum_attachments');
                Attachment::create([
                    'forumID' => $forum->forumID,
                    'userID' => Auth::id(),
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                    'uploaded_at' => now(),
                ]);
            }
        }

        $club = Club::find($validated['clubID']);
        $sender = auth()->user();

        $notification = \App\Models\Notification::create([
            'clubID'    => $club->clubID,
            'creatorID' => $sender->userID,
            'title'     => 'New Forum Request',
            'content'   => "{$sender->name} created a new forum : '{$forum->title}'. Please accept.",
        ]);

        $targetUserIDs = collect([$club->leaderID, $club->managerID])->filter()->unique();

        $notification->readers()->syncWithPivotValues($targetUserIDs->toArray(), ['is_read' => false]);

        return redirect()->route('students.forums.index')
            ->with('success', 'Forum created successfully.');
    }


    public function show(Forum $forum)
    {
        $this->ensureApprovedMemberOfClub($forum->clubID);

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
        $this->ensureApprovedMemberOfClub($forum->clubID);

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'parentID' => 'nullable|exists:forum_comments,commentID',
        ]);

        $comment = $forum->comments()->create([
            'userID' => Auth::id(),
            'message' => $validated['message'],
            'created_at' => now(),
            'parentID' => $validated['parentID'] ?? null,
            'status' => 'pending',
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filePath = $file->store('public/comment_attachments');
                Attachment::create([
                    'commentID' => $comment->commentID,
                    'userID' => Auth::id(),
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                    'uploaded_at' => now(),
                ]);
            }
        }
        return redirect()->route('students.forums.show', $forum->forumID)->with('success', 'Comment posted!');
    }
}
