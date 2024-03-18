<?php

namespace App\Http\Livewire\Dyp\Indicadores;

use App\Models\dyp\DypFlujos;
use Livewire\Component;

class IndicadorDyp extends Component
{

    public $vehiculosDyp;
    public $vehiculosTaller;
    public $vehiculosIngresados;
    public $vehiculosTerminados;

    public function render()
    {

        // busca la cantidad de vehículos activos en DYP
        $this->vehiculosDyp = DypFlujos::where('EstadoDyp', '<>','Terminado')->count();
        $this->vehiculosTaller = DypFlujos::where('EstadoDyp', '<>','Terminado')->whereNotNull('TallerID')->count();
        $this->vehiculosIngresados = DypFlujos::where('created_at', '>',date('Y-m-01 00:00:01'))->count();
        $this->vehiculosTerminados = DypFlujos::where('created_at', '>',date('Y-m-01 00:00:01'))->where('EstadoDyp', '=','Terminado')->count();


        return view('livewire.dyp.indicadores.indicador-dyp');
    }
}
