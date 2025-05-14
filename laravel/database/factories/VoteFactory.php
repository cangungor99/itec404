<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Voting;
use App\Models\VotingOption;

class VoteFactory extends Factory
{
    public function definition(): array
    {
        $voting = Voting::inRandomOrder()->first();

        return [
            'votingID' => $voting->votingID,
            'userID' => User::inRandomOrder()->first()->userID,
            'optionID' => VotingOption::where('votingID', $voting->votingID)->inRandomOrder()->first()->optionID ?? 1,
            'timestamp' => now(),
        ];
    }
}
