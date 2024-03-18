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
        Schema::create('SP_oc_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->unsignedBigInteger('ocSubCategory_id');
            $table->foreign('ocSubCategory_id')->references('id')->on('SP_oc_sub_categories');
            $table->unsignedBigInteger('costCenter_id');
//            $table->foreign('costCenter_id')->references('ID')->on('MA_Sucursales');
            $table->unsignedBigInteger('measure_id');
            $table->foreign('measure_id')->references('id')->on('SP_measures');
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')->on('SP_currencies');
            $table->timestamp('FechaCreacion')->nullable();
            $table->integer('EventoCreacionID')->nullable();
            $table->integer('UsuarioCreacionID')->nullable();
            $table->timestamp('FechaActualizacion')->nullable();
            $table->integer('EventoActualizacionID')->nullable();
            $table->integer('UsuarioActualizacionID')->nullable();
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
        Schema::dropIfExists('SP_oc_products');
    }
};
