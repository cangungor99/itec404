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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id('attachmentID');
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('resourceID')->nullable();
            $table->foreign('resourceID')->references('resourceID')->on('resources')->onDelete('cascade');
            $table->unsignedBigInteger('forumID')->nullable();
            $table->foreign('forumID')->references('forumID')->on('forums')->onDelete('cascade');
            $table->string('file_path', 255);
            $table->string('file_type', 50);
            $table->timestamp('uploaded_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
