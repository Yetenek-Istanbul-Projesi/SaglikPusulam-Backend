<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('google_place_id');
            $table->timestamps();
            
            $table->unique(['user_id', 'google_place_id']);
            $table->foreign('google_place_id')
                  ->references('google_place_id')
                  ->on('health_places')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_comparisons');
    }
};
