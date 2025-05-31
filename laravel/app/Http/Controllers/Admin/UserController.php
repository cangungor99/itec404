<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    // === Kullanıcıları Listele ===
    public function index()
    {
        // Kullanıcıları rollerle birlikte al
        $users = User::with('roles')->get();

        // Roller (select kutusu için)
        $roles = Role::select('roleID', 'name')->get();

        return view('admin.user_list', compact('users', 'roles'));
    }

    // === Kullanıcıyı Sil ===
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.user_list')->with('success', 'User deleted successfully!');
    }

    // === Kullanıcıyı Güncelle ===
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'std_no'  => 'required|string',
            'name'    => 'required|string',
            'surname' => 'required|string',
            'email'   => 'required|email',
            'roles'   => 'array'
        ]);

        $user = User::findOrFail($id);

        $user->update($validated);

        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.user_list')
            ->with('success', 'User updated successfully!');
    }
}
