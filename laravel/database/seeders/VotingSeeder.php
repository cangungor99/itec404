<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voting;
use App\Models\VotingOption;
use App\Models\Vote;
use App\Models\User;

class VotingSeeder extends Seeder
{
    public function run(): void
    {
        // 5 oylama oluştur
        Voting::factory(5)->create()->each(function ($voting) {

            // Her oylama için 3 seçenek üret
            $options = VotingOption::factory(3)->create([
                'votingID' => $voting->votingID,
            ]);

            // 5 kullanıcı oy kullansın
            $users = User::inRandomOrder()->limit(5)->get();

            foreach ($users as $user) {
                Vote::create([
                    'votingID' => $voting->votingID,
                    'userID' => $user->userID,
                    'optionID' => $options->random()->optionID,
                    'timestamp' => now(),
                ]);
            }
        });
    }
}
