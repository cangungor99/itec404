<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Club;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $clubs = Club::all();

        foreach ($clubs as $club) {
            Notification::factory(2)->create([
                'clubID' => $club->clubID,
            ]);
        }
    }
}
