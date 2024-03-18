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
        Schema::create('CPD_Calidad', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('idCpd');
            $table->integer('idTarea');
            $table->string('Patente',20)->nullable();
            $table->string('TipoCarrocería',20)->nullable();
            $table->string('Segmento',20)->nullable();
            $table->string('Marca',20)->nullable();
            $table->string('Modelo',40)->nullable();
            $table->string('Versión',60)->nullable();
            $table->string('Anio',20)->nullable();
            $table->string('VIN',20)->nullable();
            $table->integer('Puertas')->nullable();
            $table->string('Colorexterior',60)->nullable();
            $table->string('Colorinterior',60)->nullable();
            $table->integer('Tapiz')->nullable();
            $table->integer('Techo')->nullable();
            $table->integer('Tracción')->nullable();
            $table->timestamp('FechaPermiso')->nullable();
            $table->timestamp('FechaRevision')->nullable();
            $table->timestamp('FechaSoap')->nullable();
            $table->string('CantidadDuenios')->nullable();
            $table->string('Multas',20)->nullable();
            $table->string('Combustible',20)->nullable();
            $table->string('Transmisión',20)->nullable();
            $table->string('Dirección',20)->nullable();
            $table->timestamp('ÚltimaMantención')->nullable();
            $table->string('Cilindrada',20)->nullable();
            $table->string('Motor',20)->nullable();
            $table->string('KM',20)->nullable();

            $table->integer('AireAcondicionado')->nullable();
            $table->integer('Climatizador')->nullable();
            $table->integer('AlzavidriosDelantero')->nullable();
            $table->integer('AlzavidriosTrasero')->nullable();
            $table->integer('RadioVolante')->nullable();
            $table->integer('RadioDvd')->nullable();
            $table->integer('Bluetooth')->nullable();
            $table->integer('VolanteRegulable')->nullable();
            $table->integer('VolanteCuero')->nullable();
            $table->integer('VelocidadCrucero')->nullable();
            $table->integer('AndroidCarPlay')->nullable();
            $table->integer('EspejosExteriores')->nullable();
            $table->integer('EspejosRetractiles')->nullable();
            $table->integer('AsientosElectricos')->nullable();
            $table->integer('AsientosCalefaccionados')->nullable();
            $table->integer('AsientoTraseroAbatible')->nullable();
            $table->integer('AperturaMaletaInterior')->nullable();
            $table->integer('TerceraCorrida')->nullable();
            $table->integer('AsientosTermorregulables')->nullable();
            $table->integer('PartidaBotón')->nullable();
            $table->integer('CamaraRetroceso')->nullable();
            $table->integer('Cámara360')->nullable();
            $table->integer('SensorLluvia')->nullable();
            $table->integer('SensorLucesAltas')->nullable();
            $table->integer('SensorCambioPista')->nullable();
            $table->integer('AsistenciaEstacionar')->nullable();
            $table->integer('AsistenciaManejo')->nullable();
            $table->integer('AsistenciaFrenado')->nullable();
            $table->integer('VelocidadCruceroAdaptativa')->nullable();
            $table->integer('LlantasAleación')->nullable();
            $table->integer('NeblinerosDelanteros')->nullable();
            $table->integer('VidriosPolarizados')->nullable();
            $table->integer('FocosLed')->nullable();
            $table->integer('Spoiler')->nullable();
            $table->integer('BodyKit')->nullable();
            $table->integer('Pisaderas')->nullable();

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
