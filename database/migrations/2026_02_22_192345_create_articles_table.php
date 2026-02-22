<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique();
            $table->json('content')->nullable();
            $table->json('excerpt')->nullable();
            $table->string('featured_image')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->integer('wp_original_id')->nullable();
            $table->string('category')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->index('slug');
            $table->index('published_at');
        });
    }
    public function down(): void { Schema::dropIfExists('articles'); }
};
