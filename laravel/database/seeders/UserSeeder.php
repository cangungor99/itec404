<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Garantili sabit kullanıcı (userID = 1001)
        User::create([
            'userID'   => 1001,
            'std_no'   => '20000161',
            'name'     => 'Sabit',
            'surname'  => 'Yönetici',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2) Admin, Leader ve Student olarak 3 özel kullanıcı
        User::create([
            'std_no'   => '20000162',
            'name'     => 'Admin',
            'surname'  => 'User',
            'email'    => 'admin@local',
            'password' => bcrypt('secret123'),
        ]);
        User::create([
            'std_no'   => '20000163',
            'name'     => 'Leader',
            'surname'  => 'User',
            'email'    => 'leader@local',
            'password' => bcrypt('secret123'),
        ]);
        User::create([
            'std_no'   => '20000164',
            'name'     => 'Student',
            'surname'  => 'User',
            'email'    => 'student@local',
            'password' => bcrypt('secret123'),
        ]);

        // Diğer 9 kullanıcı rastgele
        User::factory(9)->create();
    }
}
