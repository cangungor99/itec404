<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Önce tüm eski verileri güncelle (ENUM'u değiştirmeden önce)
        DB::table('memberships')->where('role', 'member')->update(['role' => 'student']);

        // 2. ENUM'u şimdi güncelle
        DB::statement("ALTER TABLE memberships MODIFY role ENUM('student', 'manager', 'president', 'leader') DEFAULT 'student'");
    }

    public function down(): void
    {
        DB::table('memberships')->where('role', 'student')->update(['role' => 'member']);

        DB::statement("ALTER TABLE memberships MODIFY role ENUM('member', 'manager', 'president', 'leader') DEFAULT 'member'");
    }
};
