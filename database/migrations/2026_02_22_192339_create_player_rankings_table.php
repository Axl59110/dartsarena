<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('federation_id')->constrained()->cascadeOnDelete();
            $table->string('ranking_type')->default('order_of_merit');
            $table->integer('position');
            $table->decimal('prize_money', 12, 2)->default(0);
            $table->integer('previous_position')->nullable();
            $table->date('recorded_at');
            $table->timestamps();
            $table->index(['federation_id', 'ranking_type', 'position']);
            $table->index('player_id');
        });
    }
    public function down(): void { Schema::dropIfExists('player_rankings'); }
};
