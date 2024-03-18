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
        Schema::create('SP_oc_detail_order_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('ocCategory_id');
            $table->integer('ocSubCategory_id');
            $table->integer('ocProduct_id');
            $table->integer('amount');
            $table->integer( 'unitPrice')->default(0);
            $table->integer( 'totalPrice')->default(0);
            $table->integer('ocOrderRequest_id');
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
        Schema::dropIfExists('SP_oc_detail_order_requests');
    }
};
