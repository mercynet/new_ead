<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('payment_id')->constrained();
            $table->string('payment_method')->nullable();
            $table->uuid('reference')->unique();
            $table->integer('total')->default(0);
            $table->integer('discount')->default(0)->nullable();
            $table->integer('paid')->default(0)->nullable();
            $table->integer('commission')->default(0)->nullable();
            $table->string('status')->default('pending');
            $table->string('observations')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
