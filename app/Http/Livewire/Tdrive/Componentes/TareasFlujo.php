<?php

namespace App\Http\Livewire\Tdrive\Componentes;

use App\Models\Tdrive\TdriveTareas;
use Livewire\Component;

class TareasFlujo extends Component
{

    public $idTdrive;
    public $tareas;
    public function render()
    {
        $this->tareas = TdriveTareas::where('TdriveID',$this->idTdrive)->get();

        return view('livewire.tdrive.componentes.tareas-flujo');
    }
}
