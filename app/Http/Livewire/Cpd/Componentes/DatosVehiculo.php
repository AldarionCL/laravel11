<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\VentaVpp;
use App\Models\dyp\Vehiculos;
use App\Models\Kpi\Ventas;
use Livewire\Component;


class DatosVehiculo extends Component
{

    public $idVehiculo;
    public $vehiculo;
    public $idCpd;
    public $cpd;
    public $venta;
    public $vpp;

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
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->vehiculo = Vehiculos::where('ID',$this->cpd->VehiculoID)
        ->first();

        $this->venta = Ventas::find($this->cpd->VentaID);
        $this->vpp = VentaVpp::where('VentaID',$this->cpd->VentaID)->first();

        $this->inputMarca = $this->cpd->Marca;
        $this->inputModelo = $this->cpd->Modelo;
        $this->inputVersion = $this->cpd->Version;
        $this->inputColor = $this->cpd->Color;

        return view('livewire.cpd.componentes.datos-vehiculo');
    }



}
