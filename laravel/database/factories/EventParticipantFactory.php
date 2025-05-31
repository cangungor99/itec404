<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ClubEvent;
use App\Models\User;
use App\Models\Membership;

class EventParticipantFactory extends Factory
{
    public function definition(): array
    {
        $event = ClubEvent::inRandomOrder()->first();
        $clubID = $event?->clubID;

        $userID = Membership::where('clubID', $clubID)->inRandomOrder()->first()?->userID;

        return [
            'eventID'  => $event?->eventID,
            'userID'   => $userID,
            'joined_at'=> now(),
        ];
    }
}
