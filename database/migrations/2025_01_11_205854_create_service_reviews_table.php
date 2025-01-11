<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('comment');
            $table->decimal('rating', 2, 1);
            $table->string('photo_path')->nullable();
            $table->boolean('is_google_review')->default(false);
            $table->string('reviewer_name')->nullable(); // For Google reviews
            $table->string('google_review_id')->nullable()->unique();
            $table->timestamp('review_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_reviews');
    }
};
