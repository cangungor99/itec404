<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\Models\Club;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = Club::all();

        foreach ($clubs as $club) {
            $memberCount = $club->memberships()->count();

            if ($memberCount === 0) {
                continue;
            }

            Forum::factory(2)->create([
                'clubID' => $club->clubID,
            ]);
        }
    }
}
