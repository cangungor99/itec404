<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'clubName' => 'required|string|max:255',
            'clubDescription' => 'required|string',
            'clubStatus' => 'required|in:0,1',
            'clubPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('clubPhoto')) {
            $photo = $request->file('clubPhoto')->store('club-logos', 'public');
        } else {
            $photo = 'club-logos/default.jpg';
        }


        DB::table('clubs')->insert([
            'name' => $request->clubName,
            'description' => $request->clubDescription,
            'status' => $request->clubStatus,
            'photo' => $photo,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.manage_clubs')->with('success', 'Club created successfully!');

    }

    public function index(Request $request)
    {
        $status = $request->query('status'); // 'all', '1', '0' olabilir

        $clubsQuery = DB::table('clubs')->orderBy('created_at', 'desc');

        if ($status === '1' || $status === '0') {
            $clubsQuery->where('status', (int)$status);
        }

        $clubs = $clubsQuery->get();

        return view('admin.manage_clubs', compact('clubs'));
    }


    public function edit($id)
    {
        $club = DB::table('clubs')
            ->select('clubID', 'name', 'description', 'status', 'photo')
            ->where('clubID', $id)
            ->first();

        if (!$club) {
            return response()->json(['error' => 'Club not found.'], 404);
        }

        return response()->json($club);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'clubName' => 'required|string|max:255',
            'clubDescription' => 'required|string',
            'clubStatus' => 'required|in:0,1',
            'clubPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $club = DB::table('clubs')->where('clubID', $id)->first();

        $updateData = [
            'name' => $request->clubName,
            'description' => $request->clubDescription,
            'status' => $request->clubStatus,
        ];

        if ($request->hasFile('clubPhoto')) {
            $updateData['photo'] = $request->file('clubPhoto')->store('club-logos', 'public');
        }

        DB::table('clubs')->where('clubID', $id)->update($updateData);

        return redirect()->route('admin.manage_clubs')->with('success', 'Club updated successfully!');
    }


    public function destroy($id)
    {
        DB::table('clubs')->where('clubID', $id)->delete();

        return redirect()->route('admin.manage_clubs')->with('success', 'Club deleted successfully!');
    }
}
