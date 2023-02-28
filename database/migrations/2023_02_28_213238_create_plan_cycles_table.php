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
        Schema::create('plan_cycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained();
            $table->integer('period_access')->default(1);
            $table->string('period_type')->default('months')->comment('hours / days / weeks / months / years');
            $table->boolean('is_recurring')->default(0);
            $table->integer('discount')->default(0);
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
        Schema::dropIfExists('plan_cycles');
    }
};
