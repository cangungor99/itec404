<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Club;
use App\Models\Membership;
use App\Models\User;

class ChatFactory extends Factory
{
    public function definition(): array
    {
        $club = Club::has('memberships', '>=', 2)->inRandomOrder()->first();

        $members = $club->memberships()->inRandomOrder()->take(2)->pluck('userID');

        if ($members->count() < 2) {
            return [];
        }

        return [
            'clubID'    => $club->clubID,
            'senderID'  => $members[0],
            'receiverID'=> $members[1],
            'message'   => $this->faker->sentence(6),
            'created_at'=> now(),
            'isRead'    => $this->faker->boolean(30),
        ];
    }
}
