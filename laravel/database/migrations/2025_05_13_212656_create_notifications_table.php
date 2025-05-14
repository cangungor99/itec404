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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notificationID');
            $table->unsignedBigInteger('creatorID');
            $table->foreign('creatorID')->references('userID')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('clubID');
            $table->foreign('clubID')->references('clubID')->on('clubs')->onDelete('cascade');

            $table->string('title', 120);
            $table->text('content')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
