<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClubFactory extends Factory
{
    public function definition(): array
    {
        return [
            'clubID' => $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->words(2, true) . ' Kulübü',
            'photo' => 'default.jpg',
            'description' => $this->faker->sentence(10),
            'status' => 1,
            'managerID' => 1001, // test için sabit kullanıcı ID
            'leaderID' => 1001,  // test için sabit kullanıcı ID
            'created_at' => now(),
        ];
    }
}
