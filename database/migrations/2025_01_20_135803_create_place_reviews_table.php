<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('place_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('health_place_id')->constrained('health_places')->onDelete('cascade');
            $table->text('comment');
            $table->unsignedTinyInteger('rating');
            $table->boolean('is_anonymous')->default(false);
            $table->timestamps();
            
            // İndeksler
            $table->index(['health_place_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_reviews');
    }
};
