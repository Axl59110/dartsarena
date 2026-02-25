<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('betting_tips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('darts_match_id')->constrained()->cascadeOnDelete();
            $table->json('title');
            $table->string('prediction')->nullable();
            $table->decimal('odds_player1', 6, 2)->nullable();
            $table->decimal('odds_player2', 6, 2)->nullable();
            $table->json('analysis')->nullable();
            $table->integer('confidence')->default(50);
            $table->string('bookmaker')->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('result')->nullable();
            $table->timestamps();
            $table->index('darts_match_id');
        });
    }
    public function down(): void { Schema::dropIfExists('betting_tips'); }
};
