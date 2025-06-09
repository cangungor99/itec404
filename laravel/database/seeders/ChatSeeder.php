<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Club;
use App\Models\Chat;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        // $clubs = Club::has('memberships', '>=', 2)->get();

        // foreach ($clubs as $club) {
        //     Chat::factory(5)->create([
        //         'clubID' => $club->clubID,
        //     ]);
        // }
    }
}
