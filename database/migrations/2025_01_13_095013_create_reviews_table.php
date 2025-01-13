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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->text('comment')->nullable();
            $table->decimal('rating', 2, 1);
            $table->string('source')->default('local');
            $table->string('source_review_id')->nullable();
            $table->timestamp('source_review_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // İndeksler
            $table->index(['service_id', 'source']);
            $table->index('source_review_id');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
