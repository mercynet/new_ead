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
        Schema::table('categories', function (Blueprint $table) {
            $table->after('category_id', function (Blueprint $table) {
                $table->integer('order')->default(0)->index();
                $table->boolean('is_showcase')->default(1);
            });
            $table->after('slug', function (Blueprint $table) {
                $table->string('description')->nullable();
                $table->string('image')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['order']);
            $table->dropColumn(['order', 'is_showcase', 'description', 'image']);
        });
    }
};
