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
        Schema::table('chats', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->unsignedBigInteger('clubID')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chats', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->unsignedBigInteger('clubID')->nullable(false)->change();
        });
    }
};
