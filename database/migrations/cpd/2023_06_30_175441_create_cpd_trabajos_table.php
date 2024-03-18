<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CPD_Trabajos', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('CpdID')->unsigned();
            $table->integer('TareaID')->unsigned();
            $table->string('Estado',30)->default('Comenzado');
            $table->string('TipoTrabajo',30);
            $table->integer('InicianteID')->nullable();
            $table->integer('ResolutorID')->nullable();
            $table->timestamp('FechaInicio')->nullable();
            $table->timestamp('FechaTermino')->nullable();
            $table->integer('CumpleSla')->nullable();
            $table->integer('CumpleCalidad')->nullable();

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
        Schema::dropIfExists('CPD_Trabajos');
    }
};
