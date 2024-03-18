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
        Schema::create('CPD_Tipos', function (Blueprint $table) {
            $table->id('ID');
            $table->string('NombreTarea',50);
            $table->string('Descripcion',100);
            $table->string('Requerimiento',200);
            $table->string('Tipo');
            $table->integer('ReferenciaID')->nullable();
            $table->integer('ProximaTareaID')->nullable();
            $table->integer('PermiteRechazo')->default(1);
            $table->integer('PermitePostergar')->default(1);
            $table->integer('PermiteReabrir')->default(1);
            $table->string('PerfilResponsable',20)->nullable();
            $table->string('PerfilJefe',20)->nullable();
            $table->integer('Sla')->nullable();
            $table->integer('Ordenamiento')->nullable();
            $table->text('MotivosPostergacion')->nullable();
            $table->text('MotivosRechazo')->nullable();
            $table->integer('tarea_al_rechazar')->nullable();
            $table->boolean('sla_invertido')->default(0);
            $table->integer('PermiteCrear')->default(0);

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
        Schema::dropIfExists('cpd_tipos');
    }
};
