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

        return redirect()->back()->with('success', 'Club created successfully!');
    }

    public function index()
    {
        $clubs = DB::table('clubs')->orderBy('created_at', 'desc')->get();
        return view('admin.manage_clubs', compact('clubs'));
    }


    public function edit($id)
    {
        $club = DB::table('clubs')->where('clubID', $id)->first();

        if (!$club) {
            return redirect()->route('admin.manage_clubs')->with('error', 'Club not found.');
        }

        return response()->json($club); // Modal'da kullanmak için JSON döndür
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

        if ($request->hasFile('clubPhoto')) {
            $photo = $request->file('clubPhoto')->store('club-logos', 'public');
        } else {
            $photo = 'club-logos/default.jpg'; // burada düzeltme
        }


        DB::table('clubs')->where('clubID', $id)->update([
            'name' => $request->clubName,
            'description' => $request->clubDescription,
            'status' => $request->clubStatus,
            'photo' => $photo,
        ]);

        return redirect()->route('admin.manage_clubs')->with('success', 'Club updated successfully!');
    }


    public function destroy($id)
    {
        DB::table('clubs')->where('clubID', $id)->delete();

        return redirect()->route('admin.manage_clubs')->with('success', 'Club deleted successfully!');
    }
}
