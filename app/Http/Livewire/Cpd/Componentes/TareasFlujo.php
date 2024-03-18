<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Cpd\CpdTareas;
use Livewire\Component;

class TareasFlujo extends Component
{

    public $idCpd;
    public $tareas;
    public function render()
    {
        $this->tareas = CpdTareas::where('CpdID',$this->idCpd)->get();

        return view('livewire.cpd.componentes.tareas-flujo');
    }
}
