<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pending_users', function (Blueprint $table) {
            $table->string('email_verification_code', 6)->nullable();
            $table->string('phone_verification_code', 6)->nullable();
            $table->timestamp('codes_expire_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pending_users', function (Blueprint $table) {
            $table->dropColumn('email_verification_code');
            $table->dropColumn('phone_verification_code');
            $table->dropColumn('codes_expire_at');
        });
    }
};
