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
        Schema::create('plan_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model_type');
            $table->string('description')->nullable();
            $table->string('type')->default('relationship')->comment('relationship / count');
            $table->boolean('show_description')->default(0);
            $table->boolean('show_count_left')->default(0);
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('plan_services');
    }
};
