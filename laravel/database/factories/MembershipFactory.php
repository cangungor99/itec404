<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Club;

class MembershipFactory extends Factory
{
    public function definition(): array
    {
        return [
            'userID' => User::inRandomOrder()->first()->userID,
            'clubID' => Club::inRandomOrder()->first()->clubID,
            'role' => $this->faker->randomElement(['member', 'manager', 'president', 'leader']),
            'joined_at' => now(),
        ];
    }
}
