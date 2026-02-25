<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->json('nickname')->nullable();
            $table->string('slug')->unique();
            $table->string('nationality')->nullable();
            $table->string('country_code', 3)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('photo_url')->nullable();
            $table->json('bio')->nullable();
            $table->integer('career_titles')->default(0);
            $table->integer('career_9darters')->default(0);
            $table->decimal('career_highest_average', 5, 2)->nullable();
            $table->timestamps();
            $table->index('slug');
        });
    }
    public function down(): void { Schema::dropIfExists('players'); }
};
