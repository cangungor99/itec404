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
            $table->foreignId('clubID')->constrained('clubs')->onDelete('cascade');
            $table->foreignId('senderID')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiverID')->constrained('users')->onDelete('cascade');
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
