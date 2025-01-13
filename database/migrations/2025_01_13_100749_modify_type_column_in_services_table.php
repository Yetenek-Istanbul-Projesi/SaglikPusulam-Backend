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
        Schema::table('services', function (Blueprint $table) {
            // Önce type sütununu nullable yap
            $table->string('type')->nullable()->change();
        });

        // facility_type'dan type'a değer kopyala
        DB::statement("UPDATE services SET type = facility_type WHERE type IS NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('type')->nullable(false)->change();
        });
    }
};
