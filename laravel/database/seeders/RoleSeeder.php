<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'leader', 'manager', 'student'];
        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name]);
        }

        $map = [
            'admin@local'   => 'admin',
            'leader@local'  => 'leader',
            'manager@local' => 'manager',
            'student@local' => 'student',
        ];

        foreach ($map as $email => $roleName) {
            $user = User::where('email', $email)->first();
            $roleID = Role::where('name', $roleName)->value('roleID');

            if ($user && $roleID) {
                $user->roles()->syncWithoutDetaching([$roleID]);
            }
        }

        $excludedEmails = array_keys($map);
        $studentRoleID = Role::where('name', 'student')->value('roleID');

        User::whereNotIn('email', $excludedEmails)->each(function ($user) use ($studentRoleID) {
            $user->roles()->syncWithoutDetaching([$studentRoleID]);
        });
    }
}
