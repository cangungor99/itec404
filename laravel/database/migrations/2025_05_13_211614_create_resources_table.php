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
        Schema::create('resources', function (Blueprint $table) {
            $table->id('resourceID');
            $table->unsignedBigInteger('clubID');
            $table->foreign('clubID')->references('clubID')->on('clubs')->onDelete('cascade');

            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('file_path', 255);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
