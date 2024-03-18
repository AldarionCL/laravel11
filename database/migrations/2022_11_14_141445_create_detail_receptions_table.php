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
        Schema::create('SP_detail_receptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ocDetailOrderRequest');
            $table->foreign('ocDetailOrderRequest')->references('id')->on('SP_oc_detail_order_requests');
            $table->integer('amount');
            $table->integer('received');
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
        Schema::dropIfExists('SP_detail_receptions');
    }
};
