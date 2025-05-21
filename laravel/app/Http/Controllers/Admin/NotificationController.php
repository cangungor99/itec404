<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{
    public function store(Request $request)
    {
        // 1. Doğrulama
        $request->validate([
            'notifTitle' => 'required|string|max:255',
            'notifContent' => 'required|string',
            'clubID' => 'required|integer'
        ]);

        // 2. Bildirimi veritabanına kaydet
        DB::table('notifications')->insert([
            'title' => $request->notifTitle,
            'content' => $request->notifContent,
            'clubID' => $request->clubID,
            'creatorID' => Auth::id(),
            'created_at' => now()
        ]);

        // 3. Başarı mesajı ile geri dön
        return redirect()->back()->with('success', 'Notification created successfully!');
    }

    public function create()
{
    $clubs = DB::table('clubs')->select('clubID', 'name')->get();
    $users = DB::table('users')->select('userID', 'name', 'surname')->get();

    return view('admin.create_notification', compact('clubs', 'users'));
}

public function index()
{
    $notifications = DB::table('notifications')
        ->join('users', 'users.userID', '=', 'notifications.creatorID')
        ->join('clubs', 'clubs.clubID', '=', 'notifications.clubID')
        ->select(
            'notifications.notificationID',
            'notifications.title',
            'notifications.content',
            'users.name as creator_name',
            'clubs.name as club_name',
            'notifications.created_at'
        )
        ->orderBy('notifications.created_at', 'desc')
        ->get();

    return view('admin.notification_list', compact('notifications'));
}


public function edit($notificationID)
{
    $notification = DB::table('notifications')->where('notificationID', $notificationID)->first();
    $clubs = DB::table('clubs')->select('clubID', 'name')->get();
    $users = DB::table('users')->select('userID', 'name', 'surname')->get();

    if (!$notification) {
        return redirect()->route('admin.notification_list')->with('error', 'Notification not found.');
    }

    return view('admin.create_notification', compact('notification', 'clubs', 'users'));
}


public function update(Request $request, $notificationID)
{
    $request->validate([
        'notifTitle' => 'required|string|max:255',
        'notifContent' => 'required|string',
        'clubID' => 'required|integer'
    ]);

    DB::table('notifications')
        ->where('notificationID', $notificationID)
        ->update([
            'title' => $request->notifTitle,
            'content' => $request->notifContent,
            'clubID' => $request->clubID,
            'updated_at' => now()
        ]);

    return redirect()->route('admin.notification_list')->with('success', 'Notification updated successfully!');
}


public function destroy($notificationID)
{
    DB::table('notifications')->where('notificationID', $notificationID)->delete();

    return redirect()->route('admin.notification_list')->with('success', 'Notification deleted successfully!');
}


}
