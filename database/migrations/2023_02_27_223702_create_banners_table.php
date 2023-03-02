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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->integer('time_to_view')->default(10);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->string('video')->nullable();
            $table->string('banner')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('local')->default('hero')->comment('categories / lesson / account / hero / home_middle / home_footer');
            $table->boolean('active')->default(1);
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
