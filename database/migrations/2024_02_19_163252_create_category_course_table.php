<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('category_course', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('course_id')->index();
            $table->primary(['category_id', 'course_id'], 'category_course_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_course');
    }
};
