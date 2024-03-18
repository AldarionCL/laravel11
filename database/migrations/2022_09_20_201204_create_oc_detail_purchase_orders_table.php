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
        Schema::create('OC_detail_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ocCategory_id');
            $table->foreign('ocCategory_id')->references('id')->on('SP_oc_categories');
            $table->unsignedBigInteger('ocSubCategory_id');
            $table->foreign('ocSubCategory_id')->references('id')->on('SP_oc_sub_categories');
            $table->unsignedBigInteger('ocProduct_id');
            $table->foreign('ocProduct_id')->references('id')->on('SP_oc_products');
            $table->integer('amount');
            $table->integer( 'unitPrice');
            $table->integer( 'totalPrice');
            $table->unsignedBigInteger('branch_id');
//            $table->foreign('branch_id')->references('ID')->on('MA_Sucursales');
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
        Schema::dropIfExists('OC_detail_purchase_orders');
    }
};
