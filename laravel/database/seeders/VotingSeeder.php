<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voting;
use App\Models\VotingOption;
use App\Models\Vote;
use App\Models\Club;

class VotingSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = Club::has('memberships')->get();

        foreach ($clubs as $club) {
            $voting = Voting::factory()->create([
                'clubID' => $club->clubID,
            ]);

            $options = VotingOption::factory(3)->create([
                'votingID' => $voting->votingID,
            ]);

            $voters = $club->memberships()->inRandomOrder()->limit(5)->pluck('userID');

            foreach ($voters as $userID) {
                Vote::create([
                    'votingID' => $voting->votingID,
                    'userID'   => $userID,
                    'optionID' => $options->random()->optionID,
                    'timestamp'=> now(),
                ]);
            }
        }
    }
}
