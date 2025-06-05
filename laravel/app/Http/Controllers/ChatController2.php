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
    public function getPrivateMessages($receiverID)
{
    $authID = Auth::id();

    $messages = Chat::with('sender')
        ->where(function ($q) use ($authID, $receiverID) {
            $q->where('senderID', $authID)->where('receiverID', $receiverID);
        })
        ->orWhere(function ($q) use ($authID, $receiverID) {
            $q->where('senderID', $receiverID)->where('receiverID', $authID);
        })
        ->orderBy('created_at')
        ->get();

    return view('chat2.components.messages', compact('messages'))->render();
}
public function storePrivateMessage(Request $request)
{
    $request->validate([
        'receiverID' => 'required|exists:users,userID',
        'message' => 'required|string|max:1000'
    ]);

    $chat = Chat::create([
        'senderID' => Auth::id(),
        'receiverID' => $request->receiverID,
        'message' => $request->message,
        'isRead' => false,
    ]);

    $chat->load('sender');

    return response()->json([
        'success' => true,
        'message_html' => view('chat2.components.single-message', ['msg' => $chat])->render()
    ]);
}

public function getMessagesBetween(Request $request)
{
    $authID = auth()->id();
    $receiverID = $request->input('receiverID');

    if (!$receiverID) {
        return response()->json(['html' => '']);
    }

    $messages = Chat::with('sender')
        ->where(function ($q) use ($authID, $receiverID) {
            $q->where('senderID', $authID)->where('receiverID', $receiverID);
        })
        ->orWhere(function ($q) use ($authID, $receiverID) {
            $q->where('senderID', $receiverID)->where('receiverID', $authID);
        })
        ->orderBy('created_at')
        ->get();

    return view('chat2.components.messages', compact('messages'))->render();
}

public function getRecentChats()
{
    $authID = auth()->id();

    $chats = Chat::with(['sender', 'receiver'])
        ->where(function ($q) use ($authID) {
            $q->where('senderID', $authID)
              ->orWhere('receiverID', $authID);
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // Benzersiz konuşmaları filtrele
    $uniqueChats = collect();

    foreach ($chats as $chat) {
        $otherID = $chat->senderID == $authID ? $chat->receiverID : $chat->senderID;

        if (!$uniqueChats->has($otherID)) {
            $uniqueChats->put($otherID, $chat);
        }
    }

    return view('chat2.components.recent-chats', [
        'recentChats' => $uniqueChats->values()
    ]);
}


}
