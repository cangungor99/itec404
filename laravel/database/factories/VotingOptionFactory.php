<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Voting;

class VotingOptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'votingID' => Voting::inRandomOrder()->first()->votingID,
            'option_text' => $this->faker->name(),
        ];
    }
}
