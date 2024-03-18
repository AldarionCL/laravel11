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
        Schema::create('CPD_Flujos', function (Blueprint $table) {
            $table->id('ID');
            $table->string('Ot_principal',20)->nullable();
            $table->integer('ClienteID')->nullable();
            $table->integer('VehiculoID')->nullable();
            $table->integer('SucursalID')->unsigned();
            $table->integer('TallerID')->nullable(); // ID del taller
            $table->integer('SeguroID')->unsigned(); // ID a VT_Seguros
            $table->integer('AsesorID')->nullable(); // ID a Usuarios
            $table->integer('NumeroSiniestro')->nullable(); // ID a Usuarios
            $table->integer('ConoAsignado')->nullable(); // ID a Usuarios
            $table->string('EstadoCpd',20)->nullable(); // ID a Usuarios
            $table->string('Magnitud',20)->nullable();
            $table->string('Marca',50)->nullable();
            $table->string('Modelo',50)->nullable();
            $table->string('Color',20)->nullable();
            $table->string('Patente',20)->nullable();
            $table->string('Vin',20)->nullable();
            $table->string('ClienteNombre',50)->nullable();
            $table->string('ClienteApellido',50)->nullable();
            $table->string('ClienteEmail',100)->nullable();
            $table->string('ClienteTelefono',14)->nullable();
            $table->string('ClienteTelefono2',14)->nullable();
            $table->string('ClienteTelefono3',14)->nullable();
            $table->string('ClienteRut',14)->nullable();
            $table->string('ClienteDireccion',200)->nullable();
            $table->string('CompaniaSeguro',50)->nullable();
            $table->string('NumeroPoliza',20)->nullable();
            $table->timestamp('FechaEmisionPoliza')->nullable();
            $table->integer('PrimaNeta')->nullable();
            $table->string('Cono',5)->nullable();
            $table->integer('EvaluadorID')->nullable();
            $table->integer('ValorNeto')->nullable();
            $table->string('TipoCliente',20)->nullable();
            $table->timestamp('IngresoTaller')->nullable();
            $table->timestamp('EgresoTaller')->nullable();
            $table->timestamp('FechaEntrega')->nullable();
            $table->timestamp('FechaEstimadaEntrega')->nullable();

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
        Schema::dropIfExists('CPD_Flujos');
    }
};
