<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Club;

class ResourceFactory extends Factory
{
    public function definition(): array
    {
        $club = Club::has('memberships')->inRandomOrder()->first();

        if (!$club) {
            throw new \Exception("Kulüp yok, Resource üretilemez.");
        }

        $user = $club->memberships()->inRandomOrder()->first()?->user;

        if (!$user) {
            throw new \Exception("Üye yok, Resource userID üretilemez.");
        }

        return [
            'clubID'     => $club->clubID,
            'title'      => $this->faker->sentence(3),
            'userID'     => $user->userID,
            'description'=> $this->faker->paragraph(),
            'file_path' => 'resources/dummy.pdf',
            'created_at' => now(),
        ];
    }
}
