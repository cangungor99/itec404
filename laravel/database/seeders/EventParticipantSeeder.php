<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClubEvent;
use App\Models\EventParticipant;
use App\Models\Membership;

class EventParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $events = ClubEvent::all();

        foreach ($events as $event) {
            $members = Membership::where('clubID', $event->clubID)->inRandomOrder()->limit(5)->pluck('userID');

            foreach ($members as $userID) {
                EventParticipant::firstOrCreate([
                    'eventID' => $event->eventID,
                    'userID'  => $userID,
                ], [
                    'joined_at' => now(),
                ]);
            }
        }
    }
}
