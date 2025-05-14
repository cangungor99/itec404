<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Club;

class ForumFactory extends Factory
{
    public function definition(): array
    {
        return [
            'userID' => User::inRandomOrder()->first()->userID,
            'clubID' => Club::inRandomOrder()->first()->clubID,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'created_at' => now(),
        ];
    }
}
