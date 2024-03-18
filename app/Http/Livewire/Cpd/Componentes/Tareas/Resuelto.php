<?php

namespace App\Http\Livewire\Cpd\Componentes\Tareas;

use App\Models\Cpd\CpdTareas;
use Livewire\Component;

class Resuelto extends Component
{
    public $idTarea;
    public $tarea;

    public function render()
    {
        $this->tarea = CpdTareas::find($this->idTarea);

        return view('livewire.cpd.componentes.tareas.resuelto');
    }
}
