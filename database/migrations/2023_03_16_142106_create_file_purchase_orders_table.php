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
        Schema::create('OC_file_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->unsignedBigInteger('ocPurchaseOrder_id');
            $table->foreign('ocPurchaseOrder_id')->references('id')->on('OC_purchase_orders');
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
        Schema::dropIfExists('OC_file_purchase_orders');
    }
};
