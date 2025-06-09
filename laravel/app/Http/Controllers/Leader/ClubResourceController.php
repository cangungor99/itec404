<?php

namespace App\Http\Controllers\Leader;

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

    protected function authorizeClubAccess(Club $club): void
    {
        $userID = auth()->user()->userID;

        if ($club->leaderID !== $userID && $club->managerID !== $userID) {
            abort(403, 'You are not authorized to access this club.');
        }
    }


    public function index(Club $club, Request $request): View
    {
        $this->authorizeClubAccess($club);


        $query = $club->resources()->with('user')->latest();

        // Arama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        // Tür filtresi
        if ($request->has('type')) {
            $type = $request->type;

            $extensions = match ($type) {
                'pdf' => ['pdf'],
                'word' => ['doc', 'docx'],
                'image' => ['jpg', 'jpeg', 'png', 'gif'],
                'video' => ['mp4', 'avi', 'mov'],
                'audio' => ['mp3', 'wav'],
                'zip' => ['zip', 'rar'],
                default => []
            };

            if (!empty($extensions)) {
                $query->where(function ($q) use ($extensions) {
                    foreach ($extensions as $ext) {
                        $q->orWhere('file_path', 'like', "%.{$ext}");
                    }
                });
            }
        }

        $resources = $query->get();

        return view('leader.clubs.resources', compact('club', 'resources'));
    }

    public function store(Request $request, Club $club): RedirectResponse
    {
        $this->authorizeClubAccess($club);


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:20480',
        ]);

        $path = $request->file('file')->store('resources', 'public');

        Resource::create([
            'clubID' => $club->clubID,
            'userID' => auth()->user()->userID,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $path,
            'created_at' => now(),
        ]);

        $prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';

        return redirect()->route($prefix . '.resources.index', $club->clubID)
            ->with('success', 'Resource uploaded successfully.');
    }

    public function destroy(Club $club, Resource $resource): RedirectResponse
    {
        $this->authorizeClubAccess($club);


        if ($resource->clubID !== $club->clubID) {
            abort(403, 'This resource does not belong to your club.');
        }

        Storage::disk('public')->delete($resource->file_path);
        $resource->delete();

        return back()->with('success', 'Resource deleted.');
    }
}
