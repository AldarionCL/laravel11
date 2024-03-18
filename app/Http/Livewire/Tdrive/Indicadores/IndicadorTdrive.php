<?php

namespace App\Http\Livewire\Tdrive\Indicadores;

use App\Models\Tdrive\TdriveFlujos;
use Livewire\Component;

class IndicadorTdrive extends Component
{

    public $vehiculosTdrive;
    public $vehiculosTaller;
    public $vehiculosIngresados;
    public $vehiculosTerminados;

    public function render()
    {

        // busca la cantidad de vehículos activos en TDRIVE
        $this->vehiculosTdrive = TdriveFlujos::where('EstadoTdrive', '<>','Terminado')->count();
        $this->vehiculosTaller = TdriveFlujos::where('EstadoTdrive', '<>','Terminado')->whereNotNull('TallerID')->count();
        $this->vehiculosIngresados = TdriveFlujos::where('created_at', '>',date('Y-m-01 00:00:01'))->count();
        $this->vehiculosTerminados = TdriveFlujos::where('created_at', '>',date('Y-m-01 00:00:01'))->where('EstadoTdrive', '=','Terminado')->count();


        return view('livewire.tdrive.indicadores.indicador-tdrive');
    }
}
