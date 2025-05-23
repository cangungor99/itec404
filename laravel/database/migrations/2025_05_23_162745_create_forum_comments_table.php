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
        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id('commentID');
            $table->unsignedBigInteger('forumID');
            $table->unsignedBigInteger('userID');
            $table->text('message');
            $table->timestamp('created_at')->nullable();

            $table->foreign('forumID')->references('forumID')->on('forums')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_comments');
    }
};
