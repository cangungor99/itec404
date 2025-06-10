<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Club;
use App\Models\Resource;

class ClubResourceController extends Controller
{
    public function index(Request $request)
    {
        $clubs = Club::all();
        $clubID = $request->input('clubID');

        $resources = Resource::with('club')
            ->when($clubID, function ($query) use ($clubID) {
                $query->where('clubID', $clubID);
            })
            ->latest()
            ->get();

        return view('admin.manage_resources', compact('resources', 'clubs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'clubID' => 'required|exists:clubs,clubID',
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('file')->store('resources', 'public');

        Resource::create([
            'clubID' => $request->clubID,
            'userID' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Resource uploaded successfully.');
    }


    public function destroy(Resource $resource)
    {
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect()->back()->with('success', 'Resource deleted.');
    }
}
