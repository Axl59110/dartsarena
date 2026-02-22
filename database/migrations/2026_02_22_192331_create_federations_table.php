<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('federations', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // translatable
            $table->string('slug')->unique();
            $table->json('description')->nullable(); // translatable
            $table->string('logo_url')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('federations');
    }
};
