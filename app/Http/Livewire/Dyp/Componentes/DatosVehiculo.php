<?php

namespace App\Http\Livewire\Dyp\Componentes;

use App\Models\dyp\DypFlujos;
use App\Models\dyp\Vehiculos;
use Livewire\Component;


class DatosVehiculo extends Component
{

    public $idVehiculo;
    public $vehiculo;
    public $idDyp;
    public $dyp;
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
        $this->dyp = DypFlujos::find($this->idDyp);
        $this->vehiculo = Vehiculos::where('ID',$this->dyp->VehiculoID)
        ->first();

        $this->inputMarca = $this->dyp->Marca;
        $this->inputModelo = $this->dyp->Modelo;
        $this->inputVersion = $this->dyp->Version;
        $this->inputColor = $this->dyp->Color;

        return view('livewire.dyp.componentes.datos-vehiculo');
    }



}
