<?php

namespace App\Http\Livewire\Cpd\Indicadores;

use App\Models\Cpd\CpdFlujos;
use Livewire\Component;

class IndicadorCpd extends Component
{

    public $vehiculosCpd;
    public $vehiculosTaller;
    public $vehiculosIngresados;
    public $vehiculosTerminados;

    public function render()
    {

        // busca la cantidad de vehículos activos en CPD
        $this->vehiculosCpd = CpdFlujos::where('EstadoCpd', '<>','Finalizado')->count();
        $this->vehiculosTaller = CpdFlujos::where('EstadoCpd', '<>','Finalizado')->whereNotNull('TallerID')->count();
        $this->vehiculosIngresados = CpdFlujos::where('created_at', '>',date('Y-m-01 00:00:01'))->count();
        $this->vehiculosTerminados = CpdFlujos::where('created_at', '>',date('Y-m-01 00:00:01'))->where('EstadoCpd', '=','Finalizado')->count();


        return view('livewire.cpd.indicadores.indicador-cpd');
    }
}
