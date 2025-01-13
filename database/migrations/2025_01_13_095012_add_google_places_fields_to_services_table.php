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
            // Google Places temel bilgileri
            if (!Schema::hasColumn('services', 'google_place_id')) {
                $table->string('google_place_id')->nullable()->unique()->after('id');
            }
            
            if (!Schema::hasColumn('services', 'place_url')) {
                $table->string('place_url')->nullable()->after('website');
            }
            
            if (!Schema::hasColumn('services', 'is_open_now')) {
                $table->boolean('is_open_now')->nullable()->after('is_active');
            }
            
            if (!Schema::hasColumn('services', 'opening_hours')) {
                $table->json('opening_hours')->nullable()->after('is_open_now');
            }
            
            if (!Schema::hasColumn('services', 'photo_references')) {
                $table->json('photo_references')->nullable()->after('opening_hours');
            }
            
            // Tesis bilgileri
            if (!Schema::hasColumn('services', 'facility_type')) {
                $table->string('facility_type')->nullable()->after('type');
            }
            
            // Description alanını text'e çevir
            if (Schema::hasColumn('services', 'description')) {
                $table->text('description')->nullable()->change();
            }
            
            // İndeksler
            if (!Schema::hasColumn('services', 'google_place_id')) {
                $table->index('google_place_id');
            }
            
            if (!Schema::hasColumn('services', 'facility_type')) {
                $table->index('facility_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $columns = [
                'google_place_id',
                'place_url',
                'is_open_now',
                'opening_hours',
                'photo_references',
                'facility_type'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('services', $column)) {
                    $table->dropColumn($column);
                }
            }

            $table->dropIndex(['google_place_id']);
            $table->dropIndex(['facility_type']);
        });
    }
};
