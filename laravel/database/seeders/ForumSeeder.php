<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        Forum::factory(15)->create(); // 15 forum gönderisi
    }
}
