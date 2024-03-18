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
        Schema::create('SP_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ocCategory_id');
            $table->foreign('ocCategory_id')->references('id')->on('SP_oc_categories');
            $table->unsignedBigInteger('ocSubCategory_id');
            $table->foreign('ocSubCategory_id')->references('id')->on('SP_oc_sub_categories');
            $table->unsignedBigInteger('ocProduct_id');
            $table->foreign('ocProduct_id')->references('id')->on('SP_oc_products');
            $table->integer('amount');
            $table->integer( 'unitPrice')->default(0);
            $table->integer( 'totalPrice')->default(0);
            $table->unsignedBigInteger('ocOrderRequest_id');
            $table->integer('state')->default(0);
            $table->string('description', 500);
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
        Schema::dropIfExists('SP_stocks');
    }
};
