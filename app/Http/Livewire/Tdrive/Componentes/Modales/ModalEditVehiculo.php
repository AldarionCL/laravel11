<?php

namespace App\Http\Livewire\Tdrive\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Tdrive\TdriveFlujos;
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
        if($this->tdrive->VehiculoID)
        {
            $this->vehiculo = Vehiculos::where('MA_Vehiculos.ID',$this->tdrive->VehiculoID)
                ->first();
        }


        return view('livewire.tdrive.componentes.modales.modal-edit-vehiculo');
    }

    public function mount()
    {
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        if($this->tdrive->VehiculoID)
        {
            $this->vehiculo = Vehiculos::where('MA_Vehiculos.ID',$this->tdrive->VehiculoID)
                ->first();
        }
        $this->inputMarca = $this->tdrive->Marca;
        $this->inputModelo = $this->tdrive->Modelo;
        $this->inputVersion = $this->tdrive->Version;
        $this->inputColor = $this->tdrive->Color;

        $this->marcas =  Marca::select('ID', 'Marca' )->orderBy('Marca', 'ASC' )->get()->toArray();
        $this->modelos =  Modelos::select('ID', 'Modelo' )->orderBy('Modelo', 'ASC' )->get()->toArray();
        $this->versiones =  Versiones::select('ID', 'Version' )->orderBy('Version', 'ASC' )->get()->toArray();
        $this->colores =  ColorMarca::select('ID', 'Color' )->orderBy('Color', 'ASC' )->get()->toArray();
    }

}
