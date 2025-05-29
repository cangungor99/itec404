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
        Schema::create('club_budgets', function (Blueprint $table) {
            $table->id('budgetID');
            $table->unsignedBigInteger('clubID')->unique(); // işte bu eksikti
            $table->decimal('total_budget', 12, 2)->default(0);
            $table->decimal('budget_left', 12, 2)->default(0);
            $table->timestamps();
        
            $table->foreign('clubID')->references('clubID')->on('clubs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_budgets');
    }
};
