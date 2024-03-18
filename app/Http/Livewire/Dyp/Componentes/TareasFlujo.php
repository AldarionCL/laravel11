<?php

namespace App\Http\Livewire\Dyp\Componentes;

use App\Models\dyp\DypTareas;
use Livewire\Component;

class TareasFlujo extends Component
{

    public $idDyp;
    public $tareas;
    public function render()
    {
        $this->tareas = DypTareas::where('DypID',$this->idDyp)->get();

        return view('livewire.dyp.componentes.tareas-flujo');
    }
}
