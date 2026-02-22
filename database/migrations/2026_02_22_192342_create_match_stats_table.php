<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('match_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('darts_match_id')->constrained()->cascadeOnDelete();
            $table->string('stat_type');
            $table->string('player_position');
            $table->string('value');
            $table->timestamps();
            $table->index('darts_match_id');
        });
    }
    public function down(): void { Schema::dropIfExists('match_stats'); }
};
