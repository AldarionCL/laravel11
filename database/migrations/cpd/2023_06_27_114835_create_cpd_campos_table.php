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
        Schema::create('CPD_Campos', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('CpdTipoID');
            $table->string('Campo'); // Label del campo
            $table->string('InputName'); // nombre del input e Id
            $table->string('Tipo'); // text , number, select, textarea
            $table->string('Clase')->nullable(); // clase adional para dar
            $table->string('Placeholder')->nullable(); //texto place holder o primer texto en select
            $table->string('VarOption')->nullable(); // variable con las opciones (para livewire)
            $table->boolean('Requerido')->default(0); // campo requerido o no
            $table->integer('Orden')->default(0); // campo requerido o no

            $table->softDeletes();
            $table->timestamps();
        });
    }


};
