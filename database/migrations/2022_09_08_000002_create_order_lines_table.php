<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lines', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained();
            $table->string('model_type');
            $table->integer('model_id');
            $table->string('model_name');
            $table->integer('model_price')->default(0);
            $table->integer('model_discount')->default(0)->nullable();
            $table->integer('model_quantity')->default(0)->nullable();
            $table->json('model_details')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary(['order_id', 'model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_lines');
    }
};
