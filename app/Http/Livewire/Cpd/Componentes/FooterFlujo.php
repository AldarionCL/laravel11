<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdTareas;
use Livewire\Component;

class FooterFlujo extends Component
{

    public $idCpd;
    public $cpd;
    public $idWip;

    public function render()
    {
        $this->cpd = CpdFlujos::find($this->idCpd);
        $wip = CpdTareas::where('CpdID',$this->idCpd)->where('Estado','Abierto')->where('CpdTipoID','18')->first();

        if($wip)
            $this->idWip = $wip->ID;
        else
            $this->idWip = null;

        return view('livewire.cpd.componentes.footer-flujo');
    }
}
