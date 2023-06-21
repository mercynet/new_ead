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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('level')->default('begginer')->index()->comment('beginner; intermediate; advanced');
            $table->tinyText('summary')->nullable();
            $table->text('description')->nullable();
            $table->text('pre_requisites')->nullable();
            $table->string('target')->nullable();
            $table->string('image_featured')->nullable();
            $table->string('image_cover')->nullable();
            $table->boolean('is_fifo')->default(1);
            $table->boolean('active')->default(1);
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->integer('price')->default(0);
            $table->integer('access_months')->nullable()->comment('Number of days to access the course');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
