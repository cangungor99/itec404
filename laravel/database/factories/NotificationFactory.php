<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Club;
use App\Models\User;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        $club = Club::inRandomOrder()->first();

        $creatorID = collect([
            $club->managerID,
            $club->leaderID,
        ])->filter()->random();

        return [
            'creatorID' => $creatorID,
            'clubID'    => $club->clubID,
            'title'     => $this->faker->sentence(4),
            'content'   => $this->faker->paragraph(3),
            'created_at'=> now(),
        ];
    }
}
