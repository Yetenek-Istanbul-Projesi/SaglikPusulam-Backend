<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('health_places', function (Blueprint $table) {
            $table->id();
            $table->string('google_place_id')->unique();
            $table->json('place_data');
            $table->timestamp('last_updated');
            $table->timestamps();
            
            $table->index('google_place_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('health_places');
    }
};
