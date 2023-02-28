<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_tip_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('quiz_id')->constrained();
            $table->foreignId('quiz_tip_id')->constrained();
            $table->string('model_type');
            $table->integer('model_id');
            $table->integer('count');
            $table->timestamps();
            $table->primary(['user_id', 'quiz_id', 'quiz_tip_id', 'model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_tip_user');
    }
};
