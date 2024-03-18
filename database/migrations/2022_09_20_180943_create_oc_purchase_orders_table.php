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
        Schema::create('OC_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
//            $table->foreign('business_id')->references('ID')->on('MA_PompeyoEmpresas');
            $table->unsignedBigInteger('brand_id');
//            $table->foreign('brand_id')->references('ID')->on('MA_Gerencias');
            $table->unsignedBigInteger('branch_id');
//            $table->foreign('branch_id')->references('ID')->on('MA_Sucursales');
            $table->unsignedBigInteger('typeOfBranch_id');
//            $table->foreign('typeOfBranch_id')->references('ID')->on('MA_TipoSucursal');
            $table->unsignedBigInteger('buyers_id');
//            $table->foreign('buyers_id')->references('ID')->on('MA_Usuarios');
            $table->integer('state')->default(1);
            $table->unsignedBigInteger('provider');
            $table->foreign('provider')->references('id')->on('SP_providers');
            $table->string( 'condition' );
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
        Schema::dropIfExists('OC_purchase_orders');
    }
};
