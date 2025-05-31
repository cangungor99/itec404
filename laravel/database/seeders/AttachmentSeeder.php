<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attachment;
use App\Models\Forum;
use App\Models\Resource;

class AttachmentSeeder extends Seeder
{
    public function run(): void
    {
        if (Forum::count() > 0 || Resource::count() > 0) {
            Attachment::factory(30)->create();
        }
    }
}
