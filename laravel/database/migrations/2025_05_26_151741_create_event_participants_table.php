<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id('participantID');
            $table->unsignedBigInteger('eventID');
            $table->unsignedBigInteger('userID');
            $table->timestamp('joined_at')->nullable();

            $table->foreign('eventID')->references('eventID')->on('club_events')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');

            $table->unique(['eventID', 'userID']); // Aynı kişi aynı etkinliğe 2 kere katılamasın
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_participants');
    }
};
