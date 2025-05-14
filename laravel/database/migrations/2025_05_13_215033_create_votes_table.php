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
        Schema::create('votes', function (Blueprint $table) {
            $table->id('voteID');
            $table->unsignedBigInteger('votingID');
            $table->foreign('votingID')->references('votingID')->on('votings')->onDelete('cascade');
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('optionID');
            $table->foreign('optionID')->references('optionID')->on('voting_options')->onDelete('cascade');
            $table->timestamp('timestamp')->useCurrent();
            $table->unique(['votingID', 'userID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
