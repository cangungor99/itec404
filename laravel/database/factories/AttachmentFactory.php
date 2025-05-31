<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Forum;
use App\Models\Resource;

class AttachmentFactory extends Factory
{
    public function definition(): array
    {
        $attachToForum = $this->faker->boolean();

        if ($attachToForum) {
            $forum = Forum::has('user')->inRandomOrder()->first();

            if (!$forum || !$forum->userID) {
                throw new \Exception("Forum bulunamadı veya userID eksik");
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
            $resource = Resource::has('user')->inRandomOrder()->first();

            if (!$resource || !$resource->userID) {
                throw new \Exception("Resource bulunamadı veya userID eksik");
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
