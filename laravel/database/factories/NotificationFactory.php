<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Club;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'creatorID' => User::inRandomOrder()->first()->userID,
            'clubID' => Club::inRandomOrder()->first()->clubID,
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraph(3),
            'created_at' => now(),
        ];
    }
}
