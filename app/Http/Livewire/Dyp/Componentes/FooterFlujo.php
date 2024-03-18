<?php

namespace App\Http\Livewire\Dyp\Componentes;

use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypTareas;
use Livewire\Component;

class FooterFlujo extends Component
{

    public $idDyp;
    public $dyp;
    public $idTaller;

    public function render()
    {
        $this->dyp = DypFlujos::find($this->idDyp);
        $taller = DypTareas::where('DypID',$this->idDyp)->where('Estado','Abierto')->where('DypTipoID','13')->first();

        if($taller)
            $this->idTaller = $taller->ID;
        else
            $this->idTaller = null;

        return view('livewire.dyp.componentes.footer-flujo');
    }
}
