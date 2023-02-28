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
        Schema::create('quiz_option_user', function (Blueprint $table) {
            $table->foreignId('quiz_result_user_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('quiz_id')->constrained();
            $table->foreignId('quiz_answered_option_id')->constrained('quiz_options');
            $table->foreignId('quiz_right_option_id')->constrained('quiz_options');
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['quiz_result_user_id', 'user_id', 'quiz_id', 'quiz_answered_option_id', 'quiz_right_option_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_option_user');
    }
};
