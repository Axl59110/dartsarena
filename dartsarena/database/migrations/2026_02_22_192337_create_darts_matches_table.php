<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('darts_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->nullable();
            $table->string('round')->nullable();
            $table->dateTime('scheduled_at')->nullable();
            $table->string('status')->default('upcoming');
            $table->string('venue')->nullable();
            $table->integer('best_of_legs')->nullable();
            $table->integer('best_of_sets')->nullable();
            $table->foreignId('player1_id')->nullable()->constrained('players')->nullOnDelete();
            $table->foreignId('player2_id')->nullable()->constrained('players')->nullOnDelete();
            $table->integer('player1_score_sets')->nullable();
            $table->integer('player2_score_sets')->nullable();
            $table->integer('player1_score_legs')->nullable();
            $table->integer('player2_score_legs')->nullable();
            $table->foreignId('winner_id')->nullable()->constrained('players')->nullOnDelete();
            $table->decimal('player1_average', 5, 2)->nullable();
            $table->decimal('player2_average', 5, 2)->nullable();
            $table->decimal('player1_checkout_pct', 5, 2)->nullable();
            $table->decimal('player2_checkout_pct', 5, 2)->nullable();
            $table->integer('player1_180s')->nullable();
            $table->integer('player2_180s')->nullable();
            $table->integer('player1_highest_checkout')->nullable();
            $table->integer('player2_highest_checkout')->nullable();
            $table->timestamps();
            $table->index('season_id');
            $table->index('scheduled_at');
            $table->index('status');
        });
    }
    public function down(): void { Schema::dropIfExists('darts_matches'); }
};
