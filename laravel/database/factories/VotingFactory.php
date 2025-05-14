<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Club;

class VotingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'clubID' => Club::inRandomOrder()->first()->clubID,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_date' => now(),
            'end_date' => now()->addDays(3),
            'created_at' => now(),
        ];
    }
}
