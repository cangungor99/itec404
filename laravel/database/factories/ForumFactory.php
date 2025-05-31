<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Club;
use App\Models\Membership;

class ForumFactory extends Factory
{
    public function definition(): array
    {
        $club = Club::inRandomOrder()->first();

        $userID = Membership::where('clubID', $club->clubID)
                    ->inRandomOrder()
                    ->first()
                    ?->userID;

        return [
            'userID'     => $userID,
            'clubID'     => $club->clubID,
            'title'      => $this->faker->sentence(3),
            'description'=> $this->faker->paragraph(2),
            'status'     => 'approved',
            'created_at' => now(),
        ];
    }
}
