<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('season_id')->nullable()->constrained()->nullOnDelete();
            $table->json('title');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('venue')->nullable();
            $table->string('location')->nullable();
            $table->string('ticket_url')->nullable();
            $table->string('tv_channel')->nullable();
            $table->timestamps();
            $table->index('start_date');
        });
    }
    public function down(): void { Schema::dropIfExists('calendar_events'); }
};
