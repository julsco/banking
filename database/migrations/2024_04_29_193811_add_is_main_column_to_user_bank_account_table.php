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
        Schema::table('user_bank_account', function (Blueprint $table) {
            $table->boolean('is_main')->default(false)->after('bank_account_id');
            $table->unique(['user_id', 'is_main'], 'unique_user_main_account');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_bank_account', function (Blueprint $table) {
            //
        });
    }
};
