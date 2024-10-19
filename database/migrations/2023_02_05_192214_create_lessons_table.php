<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('course_module_id')->nullable()->constrained();
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('text'); // Use string instead of enum
            $table->string('content_path')->nullable();
            $table->time('duration')->nullable();
            $table->boolean('downloadable')->default(0);
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

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};
