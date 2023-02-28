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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->boolean('symbol_first')->default(0);
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('code');
            $table->string('symbol')->default('$');
            $table->string('precision')->default(2);
            $table->string('thousands')->default('.');
            $table->string('decimal')->default(',');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
