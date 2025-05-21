<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    public function store(Request $request)
    {
        // 1. Formdan gelen verileri doğrula
        $request->validate([
            'clubName' => 'required|string|max:255',
            'clubDescription' => 'required|string',
            'clubStatus' => 'required|in:0,1',
            'clubPhoto' => 'nullable|url'
        ]);

        // 2. Veritabanına yeni kulüp kaydını ekle
        DB::table('clubs')->insert([
            'name' => $request->clubName,
            'description' => $request->clubDescription,
            'status' => $request->clubStatus,
            'photo' => $request->clubPhoto ?: 'default.jpg',
            'created_at' => now()
        ]);

        // 3. Başarıyla geri yönlendir
        return redirect()->back()->with('success', 'Club created successfully!');
    }
}
