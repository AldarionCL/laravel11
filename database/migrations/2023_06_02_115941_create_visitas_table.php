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
        Schema::create('MA_Visitas', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('ClienteID')->nullable();
            $table->string('Rut',15)->nullable();
            $table->string('Nombres',50)->nullable();
            $table->string('Apellidos',50)->nullable();
            $table->string('Email',50)->nullable();
            $table->string('Telefono',15)->nullable();
            $table->integer('ComunaID')->nullable();
            $table->string('Direccion',150)->nullable();
            $table->timestamp('FechaCreacion')->nullable();
            $table->timestamp('Fecha_salida')->nullable();
            $table->integer('MinutosVisita')->nullable();
            $table->string('Patente',10)->nullable();
            $table->integer('Cantidad')->default(1);
            $table->string('TipoCliente',20)->nullable();
            $table->integer('UsuarioID')->nullable();
            $table->integer('SucursalID')->nullable();
            $table->integer('UsuarioSalidaID')->nullable();

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
        Schema::dropIfExists('visitas');
    }
};
