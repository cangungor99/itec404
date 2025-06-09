<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE memberships MODIFY role ENUM('member', 'manager', 'president', 'leader', 'student') DEFAULT 'member'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE memberships MODIFY role ENUM('member', 'manager', 'president', 'leader') DEFAULT 'member'");
    }
};
