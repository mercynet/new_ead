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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('model_type');
            $table->integer('model_id');
            $table->integer('price');
            $table->integer('renovation_tries')->default(1);
            $table->integer('notify_period')->default(1);
            $table->string('notify_period_type')->default('weeks')->comment('days / weeks / months');
            $table->boolean('is_recurring')->default(0);
            $table->boolean('active')->default(0);
            $table->dateTime('limit_date');
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
        Schema::dropIfExists('contracts');
    }
};
