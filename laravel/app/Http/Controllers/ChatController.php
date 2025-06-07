<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Genel chat sayfası (modern UI)
    public function index()
    {
        return view('chat.index');
    }

    // ✅ Kullanıcı arama (yeni kişiyle mesaj başlatmak için)
    public function searchUser(Request $request)
    {
        $query = $request->input('q');

        $users = User::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('surname', 'like', "%{$query}%")
              ->orWhereRaw("CONCAT(name, ' ', surname) LIKE ?", ["%{$query}%"]);
        })
        ->where('userID', '!=', auth()->id())
        ->limit(10)
        ->get(['userID', 'name', 'surname', 'email']);

        return response()->json($users);
    }

    // ✅ Özel mesaj gönderme (AJAX)
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
            'message_html' => view('chat.components.single-message', ['msg' => $chat])->render()
        ]);
    }

    // ✅ Belirli kullanıcıyla geçmiş mesajları getir
    public function getMessages(Request $request)
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

        return view('chat.components.messages', compact('messages'))->render();
    }

    // ✅ Navbar ya da sidebar için son mesajlar
    public function recentMessages()
    {
        $authID = auth()->id();

        $chats = Chat::with(['sender', 'receiver'])
            ->where(function ($q) use ($authID) {
                $q->where('senderID', $authID)
                  ->orWhere('receiverID', $authID);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $uniqueChats = collect();

        foreach ($chats as $chat) {
            $otherID = $chat->senderID == $authID ? $chat->receiverID : $chat->senderID;
            if (!$uniqueChats->has($otherID)) {
                $uniqueChats->put($otherID, $chat);
            }
        }

        return view('chat.components.recent-chats', [
            'recentChats' => $uniqueChats->values()
        ]);
    }

    // ✅ Kulüp sohbet ekranı
    public function indexClub(Club $club)
    {
        $this->authorizeClubAccess($club);

        $messages = Chat::with('sender')
            ->where('clubID', $club->clubID)
            ->orderBy('created_at')
            ->get();

        return view('chat.club', [
            'club' => $club,
            'messages' => $messages
        ]);
    }

    // ✅ Kulüp sohbetine mesaj gönderme
    public function storeClub(Request $request, Club $club)
    {
        $this->authorizeClubAccess($club);

        $request->validate(['message' => 'required|string|max:1000']);

        Chat::create([
            'clubID' => $club->clubID,
            'senderID' => Auth::id(),
            'receiverID' => null,
            'message' => $request->message,
            'isRead' => false,
        ]);

        return response()->json(['success' => true]);
    }

    // ❗ Kulüp yetkilendirmesi
    private function authorizeClubAccess(Club $club)
    {
        $user = Auth::user();

        if (!$user || !$club->memberships()->where('userID', $user->userID)->where('status', 'approved')->exists()) {
            abort(403, 'Bu kulübün sohbetine erişim yetkiniz yok.');
        }
    }
}
