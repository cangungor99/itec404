<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Club;
use App\Models\User;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        $leaders = User::whereHas('roles', fn($q) => $q->where('name', 'leader'))->get();
        $managers = User::whereHas('roles', fn($q) => $q->where('name', 'manager'))->get();

        $clubCount = min($leaders->count(), $managers->count());

        for ($i = 0; $i < $clubCount; $i++) {
            $club = Club::factory()->create([
                'leaderID' => $leaders[$i]->userID,
                'managerID' => $managers[$i]->userID,
            ]);
        }
    }
}
