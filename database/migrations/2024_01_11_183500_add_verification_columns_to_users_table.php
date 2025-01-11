<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kullanıcılar tablosuna yeni sutunlar ekledik
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('email_verification_code')->nullable();
            $table->string('phone_verification_code')->nullable();
            $table->timestamp('email_verification_code_expires_at')->nullable();
            $table->timestamp('phone_verification_code_expires_at')->nullable();
        });
    }
    
    // Kullanıcılar tablosundan yeni sutunlar silindi
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone_verified_at',
                'email_verification_code',
                'phone_verification_code',
                'email_verification_code_expires_at',
                'phone_verification_code_expires_at',
            ]);
        });
    }
};
