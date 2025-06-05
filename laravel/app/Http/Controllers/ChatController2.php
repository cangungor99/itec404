<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController2 extends Controller
{
    public function searchUser(Request $request)
    {
        $query = $request->input('q');

        $users = User::where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('surname', 'like', "%{$query}%")
                  ->orWhereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$query}%"]);
            })
            ->where('userID', '!=', auth()->id()) // kendini çıkar
            ->limit(10)
            ->get(['userID', 'name', 'surname', 'email']);

        return response()->json($users);
    }
}
