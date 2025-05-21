<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('roleID');
            $table->primary(['userID','roleID']);
            $table->foreign('userID')->references('userID')->on('users')->cascadeOnDelete();
            $table->foreign('roleID')->references('roleID')->on('roles')->cascadeOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('role_user');
    }
};
