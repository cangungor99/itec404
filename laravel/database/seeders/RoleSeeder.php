<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Rolleri oluştur
        $roles = ['admin', 'leader', 'manager', 'student'];

        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name]);
        }

        // Admin rolünü admin@local e-posta adresine ata
        $admin = User::where('email', 'admin@local')->first();
        $adminRoleID = Role::where('name', 'admin')->value('roleID');

        if ($admin && $adminRoleID) {
            $admin->roles()->syncWithoutDetaching([$adminRoleID]);
        }
    }
}
