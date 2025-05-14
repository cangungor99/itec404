<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Garantili userID = 1001 olan sabit kullanıcı
        User::create([
            'userID' => 1001,
            'std_no' => '20000161',
            'name' => 'Sabit',
            'surname' => 'Yönetici',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Diğer 9 kullanıcı rastgele
        User::factory(9)->create();
    }
}
