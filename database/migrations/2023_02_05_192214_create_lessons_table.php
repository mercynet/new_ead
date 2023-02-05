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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('course_module_id')->nullable()->constrained();
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('video_type')->default('vimeo')->comment('youtube; vimeo; internal player');
            $table->string('video_path');
            $table->time('video_duration')->nullable();
            $table->boolean('video_downloadable')->default(0);
            $table->tinyText('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('image_featured')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_free')->default(0);
            $table->boolean('is_commentable')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('lessons');
    }
};
