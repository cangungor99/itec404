<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id('membershipID');
            $table->foreignId('userID')->constrained('users')->onDelete('cascade');
            $table->foreignId('clubID')->constrained('clubs')->onDelete('cascade');
            $table->enum('role', ['member', 'manager', 'president', 'leader'])->default('member');
            $table->timestamp('joined_at')->useCurrent();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
