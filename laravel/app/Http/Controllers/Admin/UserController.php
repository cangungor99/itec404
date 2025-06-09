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
            'clubID'  => 'nullable|integer|exists:clubs,clubID',
        ]);

        $user = User::findOrFail($id);

        // 1. Temel bilgileri güncelle
        $user->update([
            'std_no'  => $validated['std_no'],
            'name'    => $validated['name'],
            'surname' => $validated['surname'],
            'email'   => $validated['email'],
        ]);

        // 2. Seçilen rolleri al
        $selectedRoleIDs = $validated['roles'] ?? [];
        $selectedRoleNames = Role::whereIn('roleID', $selectedRoleIDs)->pluck('name')->map(fn($r) => strtolower($r))->toArray();

        // 3. Her zaman student rolü eklenmeli
        $studentRole = Role::where('name', 'student')->first();
        if ($studentRole && !in_array('student', $selectedRoleNames)) {
            $selectedRoleIDs[] = $studentRole->roleID;
        }

        // 4. Rolleri eşitle
        $user->roles()->sync($selectedRoleIDs);

        // 5. Club ilişkileri varsa işlem yap
        if ($request->filled('clubID')) {
            $clubID = $validated['clubID'];
            $club = Club::find($clubID);

            // === 5a. Manager rolü varsa
            if (in_array('manager', $selectedRoleNames)) {
                if ($club && $club->managerID !== $user->userID) {
                    $club->managerID = $user->userID;
                    $club->save();
                }

                // Membership kayıt et (manager olarak)
                $user->memberships()->updateOrCreate([
                    'clubID' => $clubID,
                    'role' => 'manager',
                ], [
                    'status' => 'active',
                    'joined_at' => now(),
                ]);
            }

            // === 5b. Leader rolü varsa
            if (in_array('leader', $selectedRoleNames)) {
                if ($club && $club->leaderID !== $user->userID) {
                    $club->leaderID = $user->userID;
                    $club->save();
                }

                // Membership kayıt et (leader olarak)
                $user->memberships()->updateOrCreate([
                    'clubID' => $clubID,
                    'role' => 'leader',
                ], [
                    'status' => 'active',
                    'joined_at' => now(),
                ]);
            }

            // === 5c. Student olarak da ayrıca kayıt et
            $user->memberships()->updateOrCreate([
                'clubID' => $clubID,
                'role' => 'student',
            ], [
                'status' => 'active',
                'joined_at' => now(),
            ]);
        }

        return redirect()->route('admin.user_list')->with('success', 'User updated successfully!');
    }
}
