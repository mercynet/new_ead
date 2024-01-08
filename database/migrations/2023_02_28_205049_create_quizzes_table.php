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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->nullable()->constrained();
            $table->integer('order')->default(0);
            $table->string('question');
            $table->string('video')->nullable()->comment('Promotional video');
            $table->string('exhibition_type')->default('single_page')->comment('single_page: all questions on single page / single_question: one question for turn');
            $table->string('format_type')->default('quiz')->comment('quiz: show the results on finished / test: does not show the results and it is pre requisite to certificate');
            $table->string('question_type')->default('single')->comment('single answer / multiple answer / sum');
            $table->string('level')->default('beginner')->comment('beginner / intermediate / advanced');
            $table->boolean('is_random')->default(1);
            $table->boolean('is_free')->default(0);
            $table->boolean('allow_remake')->default(1)->comment('If the quiz allows who the student can try again');
            $table->boolean('active')->default(0);
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('quizzes');
    }
};
