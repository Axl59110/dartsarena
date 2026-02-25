<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->integer('year');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('upcoming');
            $table->string('venue')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
            $table->index(['competition_id', 'year']);
            $table->unique(['competition_id', 'year']);
        });
    }
    public function down(): void { Schema::dropIfExists('seasons'); }
};
