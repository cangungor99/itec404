<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Roller
        $roles = ['admin','leader','student'];
        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name]);
        }

        // 2) Kullanıcılara rollerin atanması

        // Sabit yönetici (ID 1001) zaten admin@example.com
        $sysAdmin = User::find(1001);
        if ($sysAdmin) {
            $sysAdmin->roles()->syncWithoutDetaching([
                Role::where('name','admin')->value('roleID'),
            ]);
        }

        // 2. admin kullanıcısı
        $admin = User::where('email','admin@local')->first();
        if ($admin) {
            $admin->roles()->syncWithoutDetaching([
                Role::where('name','admin')->value('roleID'),
            ]);
        }

        // leader@local → leader rolü
        $leader = User::where('email','leader@local')->first();
        if ($leader) {
            $leader->roles()->syncWithoutDetaching([
                Role::where('name','leader')->value('roleID'),
            ]);
        }

        // student@local → student rolü
        $student = User::where('email','student@local')->first();
        if ($student) {
            $student->roles()->syncWithoutDetaching([
                Role::where('name','student')->value('roleID'),
            ]);
        }
    }
}
