<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Özel rollerle 4 kullanıcı
        $specialUsers = [
            [
                'std_no'   => '20000162',
                'name'     => 'Admin',
                'surname'  => 'User',
                'email'    => 'admin@local',
                'password' => bcrypt('secret123'),
            ],
            [
                'std_no'   => '20000163',
                'name'     => 'Leader',
                'surname'  => 'User',
                'email'    => 'leader@local',
                'password' => bcrypt('secret123'),
            ],
            [
                'std_no'   => '20000164',
                'name'     => 'Manager',
                'surname'  => 'User',
                'email'    => 'manager@local',
                'password' => bcrypt('secret123'),
            ],
            [
                'std_no'   => '20000165',
                'name'     => 'Student',
                'surname'  => 'User',
                'email'    => 'student@local',
                'password' => bcrypt('secret123'),
            ]
        ];

        foreach ($specialUsers as $user) {
            User::create($user);
        }


        User::factory(10)->create();
    }
}
