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
        Schema::create('chats', function (Blueprint $table) {
            $table->id('chatID');
            $table->unsignedBigInteger('senderID');
            $table->unsignedBigInteger('receiverID');
            $table->unsignedBigInteger('clubID');

            $table->foreign('senderID')->references('userID')->on('users')->onDelete('cascade');
            $table->foreign('receiverID')->references('userID')->on('users')->onDelete('cascade');
            $table->foreign('clubID')->references('clubID')->on('clubs')->onDelete('cascade');
            $table->text('message');
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('isRead')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
