<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_coupons', function (Blueprint $table) {
            $table->foreignId('coupon_id')->constrained();
            $table->string('model_type');
            $table->integer('model_id');
            $table->timestamps();
            $table->primary(['coupon_id', 'model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_coupons');
    }
};
