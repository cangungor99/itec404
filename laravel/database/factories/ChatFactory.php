<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Club;

class ChatFactory extends Factory
{
    public function definition(): array
    {
        $sender = User::inRandomOrder()->first();
        $receiver = User::where('userID', '!=', $sender->userID)->inRandomOrder()->first();

        return [
            'clubID' => Club::inRandomOrder()->first()->clubID,
            'senderID' => $sender->userID,
            'receiverID' => $receiver->userID,
            'message' => $this->faker->sentence(6),
            'created_at' => now(),
            'isRead' => $this->faker->boolean(30),
        ];
    }
}
