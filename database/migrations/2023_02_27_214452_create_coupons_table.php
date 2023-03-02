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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_type')->default(0)->comment('0: Percentage; 1: Absoute');
            $table->integer('total')->default(0)->comment('0: Percentage; 1: Absoute');
            $table->integer('count_utilization')->default(1);
            $table->integer('count_user')->default(1);
            $table->string('name');
            $table->string('code')->unique();
            $table->boolean('active')->default(0);
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
