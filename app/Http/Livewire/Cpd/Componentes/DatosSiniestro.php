<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\VentaVpp;
use App\Models\Kpi\Ventas;
use Livewire\Component;

class DatosSiniestro extends Component
{
    public $idCpd;
    public $siniestro;
    public $cpd;
    public $venta;
    public $Vpp;

    public function render()
    {
        $this->siniestro= CpdFlujos::find($this->idCpd);
        $this->cpd = CpdFlujos::find($this->idCpd);

        $this->venta = Ventas::find($this->cpd->VentaID);
        $this->Vpp = VentaVpp::where('VentaID',$this->cpd->VentaID)->first();

        return view('livewire.cpd.componentes.datos-siniestro');
    }
}
