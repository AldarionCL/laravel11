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
        Schema::create('DYP_Tareas', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('DypID')->unsigned();
            $table->integer('DypTipoID')->unsigned();
            $table->string('Estado',30)->default('Abierto');
            $table->integer('ResponsableID')->nullable();
            $table->integer('ResolutorID')->nullable();
            $table->integer('SolicitanteID')->nullable();
            $table->timestamp('FechaSla')->nullable();
            $table->integer('CumpleSla')->nullable();
            $table->integer('TareaReferenciaID')->nullable();
            $table->integer('TareaReabierta')->default(0);
            $table->timestamp('FechaResolucion')->nullable();
            $table->timestamp('FechaPostergacion')->nullable();
            $table->string('MotivoPosterga',100)->nullable();
            $table->string('MotivoRechazo',100)->nullable();

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
        Schema::dropIfExists('DYP_Tareas');
    }
};
