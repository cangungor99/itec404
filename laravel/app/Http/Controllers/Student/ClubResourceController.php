<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Club;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;

class ClubResourceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $userClubs = $user->memberships()
            ->where('status', 'approved')
            ->with('club')
            ->get()
            ->pluck('club');

        $clubID = $request->clubID;

        $resourcesQuery = \App\Models\Resource::with('user', 'club');

        if ($clubID) {
            $resourcesQuery->where('clubID', $clubID);
        } else {
            $resourcesQuery->whereIn('clubID', $userClubs->pluck('clubID'));
        }

        if ($request->filled('search')) {
            $resourcesQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $resources = $resourcesQuery->orderByDesc('created_at')->get();

        return view('students.resources.index', compact('resources', 'userClubs', 'clubID'));
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $userClubs = $user->memberships()->where('status', 'approved')->pluck('clubID');

        $query = Resource::whereIn('clubID', $userClubs);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('clubID')) {
            $query->where('clubID', $request->clubID);
        }

        if ($request->filled('type')) {
            $extMap = [
                'word' => ['doc', 'docx', 'pdf'],
                'image' => ['jpg', 'jpeg', 'png', 'gif'],
                'video' => ['mp4', 'avi', 'mov'],
                'audio' => ['mp3', 'wav'],
                'zip' => ['zip', 'rar'],
            ];
            if (isset($extMap[$request->type])) {
                $query->where(function ($q) use ($extMap, $request) {
                    foreach ($extMap[$request->type] as $ext) {
                        $q->orWhere('file_path', 'like', '%.' . $ext);
                    }
                });
            }
        }

        $resources = $query->with('user')->orderByDesc('created_at')->get();

        return view('students.resources.partials.resource-list', compact('resources'));
    }
}
