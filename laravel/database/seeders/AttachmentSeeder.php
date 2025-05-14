<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    public function run(): void
    {
        Attachment::factory(20)->create(); // 20 dosya
    }
}
