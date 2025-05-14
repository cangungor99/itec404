<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\Forum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClubSeeder::class,
            MembershipSeeder::class,
            ForumSeeder::class,
            NotificationSeeder::class,
            ChatSeeder::class,
            VotingSeeder::class,
            AttachmentSeeder::class,
        ]);
    }
}
