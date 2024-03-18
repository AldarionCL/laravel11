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
        Schema::create('SP_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rut');
            $table->integer('payment_condition');
            $table->string('contact');
            $table->string('address');
            $table->string('city');
            $table->integer('postal_code');
            $table->bigInteger('phone');
            $table->string('email');
            $table->string('cuenta');
            $table->string('costCenter');
            $table->string('gasto');
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
        Schema::dropIfExists('SP_providers');
    }
};
