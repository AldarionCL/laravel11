<?php

namespace App\Http\Livewire\Dyp\Componentes\Tareas;

use App\Models\dyp\DypTareas;
use Livewire\Component;

class Resuelto extends Component
{
    public $idTarea;
    public $tarea;

    public function render()
    {
        $this->tarea = DypTareas::find($this->idTarea);

        return view('livewire.dyp.componentes.tareas.resuelto');
    }
}
