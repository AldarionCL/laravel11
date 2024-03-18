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
        Schema::create('CPD_Inspeccion', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('idCpd');
            $table->integer('idTarea');
            $table->string('Patente',20)->nullable();
            $table->string('Marca',20)->nullable();
            $table->string('Modelo',40)->nullable();
            $table->string('Versión',60)->nullable();
            $table->string('KM',20)->nullable();
            $table->string('Cilindrada',20)->nullable();
            $table->string('VIN',20)->nullable();
            $table->string('Chasis',20)->nullable();
            $table->string('Traccion',20)->nullable();
            $table->string('Color',60)->nullable();
            $table->string('Anio',20)->nullable();
            $table->string('Gasolina',20)->nullable();
            $table->string('Motor',20)->nullable();
            $table->string('Padron',20)->nullable();
            $table->string('PermisoCirculacion')->nullable();
            $table->string('RevisionTecnica',20)->nullable();
            $table->string('SeguroObligatorio',20)->nullable();
            $table->timestamp('FechaPermisoCirculacion')->nullable();
            $table->timestamp('FechaRevisionTecnica')->nullable();
            $table->timestamp('FechaSeguroObligatorio')->nullable();


            $table->string('AireAcondicionado',20)->nullable();
            $table->string('FuncionamientoAire',20)->nullable();
            $table->string('TechoPanoramico',20)->nullable();
            $table->string('ControlEstabilidad',20)->nullable();
            $table->string('GataHidraulica',20)->nullable();
            $table->string('FrenosABS',20)->nullable();
            $table->string('VelocidadCrucero',20)->nullable();
            $table->string('LaminaSeguridad',20)->nullable();
            $table->string('GataTijera',20)->nullable();
            $table->string('Airbags',20)->nullable();
            $table->string('Gps',20)->nullable();
            $table->string('SensorLluvia',20)->nullable();
            $table->string('LlaveRueda',20)->nullable();
            $table->string('CierreCentralizado',20)->nullable();
            $table->string('Bluetooth',20)->nullable();
            $table->string('TiroArrastre',20)->nullable();
            $table->string('Extintor',20)->nullable();
            $table->string('Llantas',20)->nullable();
            $table->string('SensorRetroceso',20)->nullable();
            $table->string('VolanteAjustable',20)->nullable();
            $table->string('Triangulo',20)->nullable();
            $table->string('Neblineros',20)->nullable();
            $table->string('PaddleShift',20)->nullable();
            $table->string('AientoMemoria',20)->nullable();
            $table->string('Botiquin',20)->nullable();
            $table->string('EspejosElectricos',20)->nullable();
            $table->string('AsientosElectricos',20)->nullable();
            $table->string('TapizCuero',20)->nullable();
            $table->string('ChalecoReflectante',20)->nullable();
            $table->string('AlzaVidriosElectrico',20)->nullable();
            $table->string('RadioOriginal',20)->nullable();
            $table->string('Cuero',20)->nullable();
            $table->string('LibroMantenciones',20)->nullable();
            $table->string('Direccion',20)->nullable();
            $table->string('SegundaCopiaLlave',20)->nullable();
            $table->string('Transmision',20)->nullable();
            $table->string('RuedaRepuesto',20)->nullable();
            $table->string('TechoCorredizo',20)->nullable();
            $table->string('AnclajeIsofix',20)->nullable();
            $table->string('TieneTraccion',20)->nullable();
            $table->string('Tapiz',20)->nullable();
            $table->string('Piso',20)->nullable();
            $table->string('Manubrio',20)->nullable();
            $table->string('Puertas',20)->nullable();
            $table->string('Botoneras',20)->nullable();
            $table->string('Maletero',20)->nullable();
            $table->string('Techo',20)->nullable();
            $table->string('Neumatico',20)->nullable();
            $table->string('DetalleDireccion',20)->nullable();
            $table->string('TableroInstrumento',20)->nullable();
            $table->string('4x4',20)->nullable();
            $table->string('PerdidaAgua',20)->nullable();
            $table->string('Embrague',20)->nullable();
            $table->string('AnclajeCinturon',20)->nullable();
            $table->string('EstadoMotor',20)->nullable();
            $table->string('Alineacion',20)->nullable();
            $table->string('Calefaccion',20)->nullable();
            $table->string('Frenos',20)->nullable();
            $table->string('PerdidaAceite',20)->nullable();
            $table->string('Parabrisas',20)->nullable();
            $table->string('CajaDiferencial',20)->nullable();
            $table->string('Luces',20)->nullable();
            $table->string('selecParabrisas',20)->nullable();
            $table->string('Correas',20)->nullable();
            $table->string('Mangueras',20)->nullable();
            $table->string('Bocina',20)->nullable();

            $table->integer('PorcenjateBateria')->nullable();
            $table->string('selecVidaBateria',20)->nullable();
            $table->text('ComentarioDocumentacion')->nullable();
            $table->text('ComentarioDetallesTecnicos')->nullable();

            $table->string('ImagenFrontal',200)->nullable();
            $table->string('ImagenDerecha',200)->nullable();
            $table->string('ImagenIzquierda',200)->nullable();
            $table->string('ImagenTrasera',200)->nullable();
            $table->string('ImagenInterna1',200)->nullable();
            $table->string('ImagenInterna2',200)->nullable();
            $table->string('ImagenAdicional1',200)->nullable();
            $table->string('ImagenAdicional2',200)->nullable();

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
