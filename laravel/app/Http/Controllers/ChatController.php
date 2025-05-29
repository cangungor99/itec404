<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private function getSidebarData()
    {
        if (!Auth::check()) {
            return [
                'clubChats' => collect(),
                'privateChats' => collect(),
            ];
        }

        $authID = Auth::id();

        $clubChats = Club::whereHas('memberships', function ($q) use ($authID) {
            $q->where('userID', $authID)->where('status', 'approved');
        })->get();

        $privateChats = User::where('userID', '!=', $authID)->get();
        return compact('clubChats', 'privateChats');
    }


    private function isClubMember(?User $user, Club $club): bool
    {
        if (!$user) {
            \Log::warning("isClubMember: Kullanıcı null, erişim reddedildi.");
            return false;
        }

        \Log::info("isClubMember check: userID={$user->userID}, clubID={$club->clubID}");

        return $club->memberships()
            ->where('userID', $user->userID)
            ->where('status', 'approved')
            ->exists();
    }

    public function indexClub(Club $club)
    {
        \Log::info("Test | Controller clubID={$club->clubID}, userID=" . Auth::id());

        $memberIDs = $club->memberships()->pluck('userID')->toArray();
        \Log::info("Test | This club's member IDs: " . implode(', ', $memberIDs));

        if (!$this->isClubMember(Auth::user(), $club)) {
            \Log::info("Erişim REDDEDİLDİ: userID=" . Auth::id() . ", clubID=" . $club->clubID);
            abort(403, 'Bu kulübün sohbetine erişim yetkiniz yok.');
        }
        $messages = Chat::with('sender')
            ->where('clubID', $club->clubID)
            ->orderBy('created_at')
            ->get();

        return view('chat.club', array_merge(
            ['club' => $club, 'messages' => $messages],
            $this->getSidebarData()
        ));
    }

    public function storeClub(Request $request, Club $club)
    {
        if (!$this->isClubMember(Auth::user(), $club)) {
            return response()->json(['error' => 'Bu kulübe mesaj atamazsın.'], 403);
        }

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

    public function indexPrivate(User $user)
    {
        $authID = Auth::id();

        $messages = Chat::with('sender')
            ->where(function ($q) use ($authID, $user) {
                $q->where('senderID', $authID)->where('receiverID', $user->userID);
            })
            ->orWhere(function ($q) use ($authID, $user) {
                $q->where('senderID', $user->userID)->where('receiverID', $authID);
            })
            ->orderBy('created_at')
            ->get();

        return view('chat.private', array_merge(
            ['user' => $user, 'messages' => $messages],
            $this->getSidebarData()
        ));
    }

    public function storePrivate(Request $request, User $user)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        Chat::create([
            'senderID' => Auth::id(),
            'receiverID' => $user->userID,
            'message' => $request->message,
            'isRead' => false,
        ]);

        return response()->json(['success' => true]);
    }

    public function getMessages(Request $request)
    {
        $authID = Auth::id();
        $type = $request->type;
        $id = $request->id;

        if ($type === 'club') {
            $messages = Chat::with('sender')
                ->where('clubID', $id)
                ->orderBy('created_at')
                ->get();
        } elseif ($type === 'private') {
            $messages = Chat::with('sender')
                ->where(function ($q) use ($authID, $id) {
                    $q->where('senderID', $authID)->where('receiverID', $id);
                })
                ->orWhere(function ($q) use ($authID, $id) {
                    $q->where('senderID', $id)->where('receiverID', $authID);
                })
                ->orderBy('created_at')
                ->get();
        } else {
            return response()->json([], 400);
        }

        return view('chat.components.messages', compact('messages'))->render();
    }

    public function recentMessages()
    {
        $authID = Auth::id();

        if (!$authID) {
            return view('chat.components.navbar-messages', ['recentMessages' => collect()]);
        }

        $approvedClubIDs = Club::whereHas('memberships', function ($q) use ($authID) {
            $q->where('userID', $authID)->where('status', 'approved');
        })->pluck('clubID');

        $allMessages = Chat::with(['sender', 'club'])
            ->where(function ($q) use ($authID, $approvedClubIDs) {
                $q->where('receiverID', $authID)
                    ->orWhere(function ($q2) use ($approvedClubIDs) {
                        $q2->whereNull('receiverID')->whereIn('clubID', $approvedClubIDs);
                    });
            })
            ->latest('created_at')
            ->get();

        $recentMessages = $allMessages
            ->sortByDesc('created_at')
            ->unique(function ($msg) use ($authID) {
                return $msg->clubID
                    ? 'club_' . $msg->clubID
                    : 'user_' . ($msg->senderID == $authID ? $msg->receiverID : $msg->senderID);
            })
            ->take(5)
            ->values();

        return view('chat.components.navbar-messages', compact('recentMessages'));
    }




    public function inbox()
    {
        $authID = Auth::id();

        if (!$authID) {
            abort(403, 'Yetkisiz erişim.');
        }

        $privateMessages = Chat::with(['sender', 'receiver'])
            ->where('senderID', $authID)
            ->orWhere('receiverID', $authID)
            ->latest('created_at')
            ->get();

        return view('chat.inbox', array_merge(
            ['privateMessages' => $privateMessages],
            $this->getSidebarData()
        ));
    }
}
