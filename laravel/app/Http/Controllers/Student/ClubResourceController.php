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
    public function index(Club $club, Request $request): View
    {
        $user = auth()->user();

        $membership = $user->memberships()
            ->where('clubID', $club->clubID)
            ->first();

        $isMember = $membership && $membership->status === 'approved';

        if (! $isMember) {
            abort(403, 'Unauthorized.');
        }

        $query = $club->resources()->with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

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

        return view('students.clubs.resources', compact('club', 'resources', 'isMember', 'membership'));
    }

    public function store(Request $request, Club $club): RedirectResponse
    {
        $user = auth()->user();

        // Yetkisiz giriş engelle
        $membership = $user->memberships()
            ->where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->first();

        if (!$membership) {
            abort(403, 'You are not authorized to upload resources.');
        }

        \Log::info('Form geldi. Dosya:', ['hasFile' => $request->hasFile('file')]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        $path = $request->file('file')->store('resources', 'public');

        Resource::create([
            'clubID' => $club->clubID,
            'userID' => $user->userID,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $path,
            'created_at' => now(),
        ]);

        return redirect()->route('students.clubs.resources', $club->clubID)
            ->with('success', 'Resource uploaded successfully.');
    }
    public function destroy(Club $club, Resource $resource): RedirectResponse
    {
        $user = auth()->user();

        // Sadece kendi yüklediği dosyayı silebilsin
        if ($resource->userID !== $user->userID) {
            abort(403, 'You are not authorized to delete this resource.');
        }

        // Dosya varsa storage'dan sil
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect()->route('students.clubs.resources', $club->clubID)
            ->with('success', 'Resource deleted successfully.');
    }
}
