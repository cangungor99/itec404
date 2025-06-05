<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Club;


class UserController extends Controller
{
    // === Kullanıcıları Listele ===
    public function index()
    {
        // Kullanıcıları rollerle birlikte al
        $users = User::with(['roles', 'memberships.club'])->get();


        // Roller (select kutusu için)
        $roles = Role::select('roleID', 'name')->get();

        //Klüpler
        $clubs = Club::select('clubID', 'name')->get();

        return view('admin.user_list', compact('users', 'roles', 'clubs'));
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
            'roles'   => 'array',
            'clubID'  => 'nullable|integer|exists:clubs,clubID'
        ]);

        $user = User::findOrFail($id);

        // Temel bilgileri güncelle
        $user->update([
            'std_no'  => $validated['std_no'],
            'name'    => $validated['name'],
            'surname' => $validated['surname'],
            'email'   => $validated['email'],
        ]);

        // Rolleri senkronize et
        $user->roles()->sync($validated['roles'] ?? []);

        // Seçilen rollerin isimlerini al (lowercase)
        $selectedRoleNames = Role::whereIn('roleID', $validated['roles'] ?? [])
            ->pluck('name')
            ->map(fn($name) => strtolower($name))
            ->toArray();

        // Eğer clubID gönderilmişse işle
        if ($request->filled('clubID')) {
            $clubID = $validated['clubID'];

            // Mevcut membership varsa getir, yoksa oluştur
            $membership = $user->memberships()->firstOrNew([
                'clubID' => $clubID,
            ]);

            // Rol ataması
            if (in_array('leader', $selectedRoleNames)) {
                $membership->role = 'leader';

                // === Club tablosundaki leaderID güncelle
                $club = \App\Models\Club::find($clubID);
                if ($club && $club->leaderID !== $user->userID) {
                    $club->leaderID = $user->userID;
                    $club->save();
                }
            } elseif (in_array('manager', $selectedRoleNames)) {
                $membership->role = 'manager';

                // === Club tablosundaki managerID güncelle
                $club = \App\Models\Club::find($clubID);
                if ($club && $club->managerID !== $user->userID) {
                    $club->managerID = $user->userID;
                    $club->save();
                }
            }

            $membership->status = 'active';
            $membership->joined_at = now();
            $membership->save();
        }

        return redirect()->route('admin.user_list')
            ->with('success', 'User updated successfully!');
    }
}
