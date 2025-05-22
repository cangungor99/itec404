<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Listeleme
    public function index()
{
    $users = DB::table('users')->get();

    // Her kullanıcının rollerini al (opsiyonel ama önerilir)
    foreach ($users as $user) {
        $roleIDs = DB::table('role_user')->where('userID', $user->userID)->pluck('roleID')->toArray();
        $user->roles = $roleIDs;
    }

    $roles = DB::table('roles')->select('roleID', 'name')->get();

    return view('admin.user_list', compact('users', 'roles'));
}

    // Silme
    public function destroy($id)
    {
        DB::table('users')->where('userID', $id)->delete();
        DB::table('role_user')->where('userID', $id)->delete();
        return redirect()->route('admin.user_list')->with('success', 'User deleted successfully!');
    }

    // Güncelleme
    public function update(Request $request)
    {
        $request->validate([
            'userID' => 'required|integer',
            'name' => 'required|string',
            'surname' => 'required|string',
            'std_no' => 'required|string',
            'email' => 'required|email',
            'roles' => 'array'
        ]);

        DB::table('users')->where('userID', $request->userID)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'std_no' => $request->std_no,
            'email' => $request->email,
            'updated_at' => now()
        ]);

        // Roller güncelleniyor
        DB::table('role_user')->where('userID', $request->userID)->delete();
        foreach ($request->roles as $roleID) {
            DB::table('role_user')->insert([
                'userID' => $request->userID,
                'roleID' => $roleID
            ]);
        }

        return redirect()->back()->with('success', 'User updated successfully!');
    }
}
