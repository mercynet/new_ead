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
        Schema::create('course_formation', function (Blueprint $table) {
            $table->foreignId('course_id')->constrained();
            $table->foreignId('formation_id')->constrained();
            $table->timestamps();
            $table->primary(['course_id', 'formation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_formation');
    }
};
