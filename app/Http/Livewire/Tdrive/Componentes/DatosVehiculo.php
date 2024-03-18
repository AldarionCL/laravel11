<?php

namespace App\Http\Livewire\Tdrive\Componentes;

use App\Models\Tdrive\TdriveFlujos;
use App\Models\dyp\Vehiculos;
use Livewire\Component;


class DatosVehiculo extends Component
{

    public $idVehiculo;
    public $vehiculo;
    public $idTdrive;
    public $tdrive;
    public $marcas;
    public $modelos;
    public $versiones;
    public $colores;
    public $inputMarca;
    public $inputModelo;
    public $inputVersion;
    public $inputColor;


    public function render()
    {
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $this->vehiculo = Vehiculos::where('ID',$this->tdrive->VehiculoID)
        ->first();

        $this->inputMarca = $this->tdrive->Marca;
        $this->inputModelo = $this->tdrive->Modelo;
        $this->inputVersion = $this->tdrive->Version;
        $this->inputColor = $this->tdrive->Color;

        return view('livewire.tdrive.componentes.datos-vehiculo');
    }



}
