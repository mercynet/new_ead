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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->integer('price')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('is_test')->default(0);
            $table->boolean('is_commissioned')->default(0);
            $table->boolean('is_promotional')->default(0);
            $table->boolean('is_showcase')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->dateTime('countdown_limit')->nullable();
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('plans');
    }
};
