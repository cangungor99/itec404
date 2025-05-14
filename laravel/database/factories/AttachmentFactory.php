<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Forum;
use App\Models\Resource;

class AttachmentFactory extends Factory
{
    public function definition(): array
    {
        // Rastgele bir forum veya resource seç, biri null olabilir
        $useForum = $this->faker->boolean();

        return [
            'resourceID' => $useForum ? null : Resource::inRandomOrder()->first()?->resourceID,
            'forumID'    => $useForum ? Forum::inRandomOrder()->first()?->forumID : null,
            'userID'     => User::inRandomOrder()->first()->userID,
            'file_path'  => 'uploads/' . $this->faker->word() . '.pdf',
            'file_type'  => 'pdf',
            'uploaded_at' => now(),
        ];
    }
}
