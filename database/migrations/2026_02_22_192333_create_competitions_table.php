<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('federation_id')->constrained()->cascadeOnDelete();
            $table->json('name');
            $table->string('slug')->unique();
            $table->json('description')->nullable();
            $table->string('format')->nullable();
            $table->string('prize_money')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->index('federation_id');
        });
    }
    public function down(): void { Schema::dropIfExists('competitions'); }
};
