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
        Schema::create('plan_item_plan', function (Blueprint $table) {
            $table->foreignId('plan_id')->constrained();
            $table->foreignId('plan_item_id')->constrained();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->primary(['plan_id', 'plan_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_item_plan');
    }
};
