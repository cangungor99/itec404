<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;
use App\Models\Club;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = Club::has('memberships')->get();

        foreach ($clubs as $club) {
            Resource::factory(2)->create([
                'clubID' => $club->clubID,
            ]);
        }
    }
}
