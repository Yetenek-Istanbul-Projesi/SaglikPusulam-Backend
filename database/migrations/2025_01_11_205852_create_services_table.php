<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->string('type');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('working_hours')->nullable();
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('contact_info')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('review_count')->default(0);
            $table->string('google_place_id')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
