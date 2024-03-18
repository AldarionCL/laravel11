<?php

namespace App\Http\Livewire\Tdrive\Componentes;

use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTareas;
use Livewire\Component;

class FooterFlujo extends Component
{

    public $idTdrive;
    public $tdrive;
    public $idTaller;

    public function render()
    {
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $taller = TdriveTareas::where('TdriveID',$this->idTdrive)->where('Estado','Abierto')->where('TdriveTipoID','13')->first();

        if($taller)
            $this->idTaller = $taller->ID;
        else
            $this->idTaller = null;

        return view('livewire.tdrive.componentes.footer-flujo');
    }
}
