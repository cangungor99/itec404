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
            $table->foreignId('resourceID')->nullable()->constrained('resources')->onDelete('cascade');
            $table->foreignId('forumID')->nullable()->constrained('forums')->onDelete('cascade');
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
