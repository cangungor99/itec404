<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resource;
use App\Models\Forum;
use App\Models\User;

class AttachmentFactory extends Factory
{
    public function definition(): array
    {
        $attachToForum = $this->faker->boolean();

        if ($attachToForum) {
            $forum = \App\Models\Forum::inRandomOrder()->first();

            if (!$forum || !$forum->userID) {
                // Hiçbir değer dönme — Laravel'e bu kaydı atla demeliyiz
                return [
                    'forumID' => null,
                    'resourceID' => null,
                    'userID' => null,
                    'file_path' => null,
                    'file_type' => null,
                    'uploaded_at' => null,
                ];
            }

            return [
                'forumID'     => $forum->forumID,
                'resourceID'  => null,
                'userID'      => $forum->userID,
                'file_path'   => 'uploads/' . $this->faker->word() . '.pdf',
                'file_type'   => 'pdf',
                'uploaded_at' => now(),
            ];
        } else {
            $resource = \App\Models\Resource::inRandomOrder()->first();

            if (!$resource || !$resource->userID) {
                return [
                    'forumID' => null,
                    'resourceID' => null,
                    'userID' => null,
                    'file_path' => null,
                    'file_type' => null,
                    'uploaded_at' => null,
                ];
            }

            return [
                'forumID'     => null,
                'resourceID'  => $resource->resourceID,
                'userID'      => $resource->userID,
                'file_path'   => 'uploads/' . $this->faker->word() . '.docx',
                'file_type'   => 'docx',
                'uploaded_at' => now(),
            ];
        }
    }
}
