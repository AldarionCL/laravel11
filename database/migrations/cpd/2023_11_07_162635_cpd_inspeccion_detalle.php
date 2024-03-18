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
        Schema::create('CPD_Inspeccion_Detalle', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('idCpd');
            $table->integer('idInspeccion');
            $table->string('TipoDanio',300)->nullable();
            $table->integer('Costo')->nullable();
            $table->string('Comentario',400)->nullable();
            $table->string('Ubicacion',200)->nullable();

            $table->softDeletes();
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
        //
    }
};
