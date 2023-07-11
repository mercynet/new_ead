<?php

use App\Enums\Active;
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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('commission')->default(0);
            $table->string('bank_iban')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('identify_image')->nullable();
            $table->boolean('financial_approved')->default(0);
            $table->boolean('available_meetings')->default(1);
            $table->string('sex_meetings')->default('both')->comment('male / female / both');
            $table->string('meeting_type')->default('both')->comment('online / personal / both');
            $table->string('status')->default(Active::inactive->name);
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
        Schema::dropIfExists('instructors');
    }
};
