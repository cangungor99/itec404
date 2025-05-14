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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id('clubID');
            $table->unsignedBigInteger('managerID')->nullable();
            $table->unsignedBigInteger('leaderID')->nullable();

            $table->foreign('managerID')->references('userID')->on('users')->nullOnDelete();
            $table->foreign('leaderID')->references('userID')->on('users')->nullOnDelete();

            $table->string('name', 100);
            $table->string('photo', 255);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
