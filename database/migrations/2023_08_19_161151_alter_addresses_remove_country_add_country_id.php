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
        Schema::table('addresses', function (Blueprint $table) {
            $table->after('user_id', fn($table) => $table->foreignId('country_id')->constrained());
            $table->dropColumn(['country']);
            $table->index('zip_code');
            $table->index('address');
            $table->index(['city', 'state']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->dropForeign(['country_id']);
            $table->dropIndex(['zip_code']);
            $table->dropIndex(['address']);
            $table->dropIndex(['city', 'state']);
            $table->dropColumn(['country_id']);
        });
    }
};
