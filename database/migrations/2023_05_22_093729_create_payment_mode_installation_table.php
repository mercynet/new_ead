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
        Schema::create('payment_method_payment', function (Blueprint $table) {
            $table->foreignId('payment_mode_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->timestamps();
            $table->primary(['payment_mode_id', 'payment_method_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_mode_installation');
    }
};
