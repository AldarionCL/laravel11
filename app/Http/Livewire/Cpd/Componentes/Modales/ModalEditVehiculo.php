<?php

namespace App\Http\Livewire\Cpd\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Cpd\CpdFlujos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Versiones;
use App\Models\dyp\Vehiculos;
use Illuminate\Http\Request;
use LivewireUI\Modal\ModalComponent;


class ModalEditVehiculo extends ModalComponent
{
    public $idVehiculo;
    public $vehiculo;
    public $idCpd;
    public $cpd;
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
        $this->vehiculo = Vehiculos::where('MA_Vehiculos.ID',$this->cpd->VehiculoID)
            ->first();

        return view('livewire.cpd.componentes.modales.modal-edit-vehiculo');
    }

    public function mount()
    {
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->vehiculo = Vehiculos::where('MA_Vehiculos.ID',$this->cpd->VehiculoID)
            ->first();
        $this->inputMarca = $this->cpd->Marca;
        $this->inputModelo = $this->cpd->Modelo;
        $this->inputVersion = $this->cpd->Version;
        $this->inputColor = $this->cpd->Color;

        $this->marcas =  Marca::select('ID', 'Marca' )->orderBy('Marca', 'ASC' )->get()->toArray();
        $this->modelos =  Modelos::select('ID', 'Modelo' )->orderBy('Modelo', 'ASC' )->get()->toArray();
        $this->versiones =  Versiones::select('ID', 'Version' )->orderBy('Version', 'ASC' )->get()->toArray();
        $this->colores =  ColorMarca::select('ID', 'Color' )->orderBy('Color', 'ASC' )->get()->toArray();
    }


}
