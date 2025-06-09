<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@local'],
            [
                'std_no'   => '20000162',
                'name'     => 'Admin',
                'surname'  => 'User',
                'password' => bcrypt('secret123'),
            ]
        );
    }
}
