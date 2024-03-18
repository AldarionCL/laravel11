<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *|
     * @return void
     */
    public function up()
    {
        Schema::create('OC_receptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ocOrderRequest_id');
            $table->foreign('ocOrderRequest_id')->references('id')->on('OC_purchase_orders');
            $table->string('document');
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
        Schema::dropIfExists('OC_receptions');
    }
};
