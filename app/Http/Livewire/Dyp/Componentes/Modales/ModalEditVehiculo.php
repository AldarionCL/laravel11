<?php

namespace App\Http\Livewire\Dyp\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Illuminate\Http\Request;
use LivewireUI\Modal\ModalComponent;


class ModalEditVehiculo extends ModalComponent
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
        if($this->dyp->VehiculoID)
        {
            $this->vehiculo = Vehiculos::where('MA_Vehiculos.ID',$this->dyp->VehiculoID)
                ->first();
        }


        return view('livewire.dyp.componentes.modales.modal-edit-vehiculo');
    }

    public function mount()
    {
        $this->dyp = DypFlujos::find($this->idDyp);
        if($this->dyp->VehiculoID)
        {
            $this->vehiculo = Vehiculos::where('MA_Vehiculos.ID',$this->dyp->VehiculoID)
                ->first();
        }
        $this->inputMarca = $this->dyp->Marca;
        $this->inputModelo = $this->dyp->Modelo;
        $this->inputVersion = $this->dyp->Version;
        $this->inputColor = $this->dyp->Color;

        $this->marcas =  Marca::select('ID', 'Marca' )->orderBy('Marca', 'ASC' )->get()->toArray();
        $this->modelos =  Modelos::select('ID', 'Modelo' )->orderBy('Modelo', 'ASC' )->get()->toArray();
        $this->versiones =  Versiones::select('ID', 'Version' )->orderBy('Version', 'ASC' )->get()->toArray();
        $this->colores =  ColorMarca::select('ID', 'Color' )->orderBy('Color', 'ASC' )->get()->toArray();
    }

}
