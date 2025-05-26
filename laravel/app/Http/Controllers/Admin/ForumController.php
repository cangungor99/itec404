<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;


class ForumController extends Controller
{
    public function index()
    {
        $pendingForums = Forum::with(['user', 'club'])
            ->where('status', 'pending')
            ->get();

        $approvedForums = Forum::with(['user', 'club'])
            ->where('status', 'approved')
            ->get();

        return view('admin.manage_forums', compact('pendingForums', 'approvedForums'));
    }

    public function approve($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->status = 'approved';
        $forum->save();

        return redirect()->back()->with('success', 'Forum approved successfully.');
    }

    public function reject($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->delete();

        return redirect()->back()->with('success', 'Forum rejected and deleted.');
    }
}
