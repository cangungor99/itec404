<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Resource;
use App\Models\Club;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $clubID = $request->input('club_id');

        $resources = Resource::with(['user', 'club'])
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($clubID, function ($query, $clubID) {
                $query->where('clubID', $clubID);
            })
            ->latest()
            ->get();

        $clubs = Club::select('clubID', 'name')->get();

        return view('admin.manage_resource', compact('resources', 'clubs', 'search', 'clubID'));
    }

    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);

        // Fiziksel dosyayı sil
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return redirect()->route('admin.resources.index')->with('success', 'Resource deleted successfully.');
    }
}
