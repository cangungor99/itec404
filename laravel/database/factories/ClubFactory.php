<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClubFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(2, true) . ' Kulübü',
            'photo'       => 'default.jpg',
            'description' => $this->faker->sentence(10),
            'status'      => 1,
            'created_at'  => now(),
        ];
    }
}
