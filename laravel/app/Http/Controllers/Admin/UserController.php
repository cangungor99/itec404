<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Club;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'memberships.club'])->get();
        $roles = Role::select('roleID', 'name')->get();
        $clubs = Club::select('clubID', 'name')->get();

        return view('admin.user_list', compact('users', 'roles', 'clubs'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.user_list')->with('success', 'User deleted successfully!');
    }

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

        $user->update([
            'std_no'  => $validated['std_no'],
            'name'    => $validated['name'],
            'surname' => $validated['surname'],
            'email'   => $validated['email'],
        ]);

        $selectedRoleIDs = $validated['roles'] ?? [];
        $selectedRoleNames = Role::whereIn('roleID', $selectedRoleIDs)->pluck('name')->map(fn($r) => strtolower($r))->toArray();
        $studentRole = Role::where('name', 'student')->first();
        if ($studentRole && !in_array('student', $selectedRoleNames)) {
            $selectedRoleIDs[] = $studentRole->roleID;
        }

        $user->roles()->sync($selectedRoleIDs);

        if ($request->filled('clubID')) {
            $clubID = $validated['clubID'];
            $club = Club::find($clubID);

            if (in_array('manager', $selectedRoleNames)) {
                if ($club && $club->managerID !== $user->userID) {
                    $club->managerID = $user->userID;
                    $club->save();
                }

                $user->memberships()->updateOrCreate([
                    'clubID' => $clubID,
                    'role' => 'manager',
                ], [
                    'status' => 'approved',
                    'joined_at' => now(),
                ]);
            }

            if (in_array('leader', $selectedRoleNames)) {
                if ($club && $club->leaderID !== $user->userID) {
                    $club->leaderID = $user->userID;
                    $club->save();
                }

                $user->memberships()->updateOrCreate([
                    'clubID' => $clubID,
                    'role' => 'leader',
                ], [
                    'status' => 'approved',
                    'joined_at' => now(),
                ]);
            }

            $user->memberships()->updateOrCreate([
                'clubID' => $clubID,
                'role' => 'student',
            ], [
                'status' => 'approved',
                'joined_at' => now(),
            ]);
        }

        return redirect()->route('admin.user_list')->with('success', 'User updated successfully!');
    }
}
