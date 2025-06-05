<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notificationID');
            $table->unsignedBigInteger('userID');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('notificationID')->references('notificationID')->on('notifications')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_user');
    }
};
