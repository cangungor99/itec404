<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Club;

class ClubEventFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 days', '+10 days');
        $end = (clone $start)->modify('+2 hours');

        return [
            'clubID'     => Club::inRandomOrder()->first()->clubID,
            'title'      => $this->faker->sentence(3),
            'description'=> $this->faker->paragraph(),
            'location'   => $this->faker->city(),
            'start_time' => $start,
            'end_time'   => $end,
            'created_at' => now(),
        ];
    }
}
