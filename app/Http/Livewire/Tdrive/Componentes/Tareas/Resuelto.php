<?php

namespace App\Http\Livewire\Tdrive\Componentes\Tareas;

use App\Models\Tdrive\TdriveTareas;
use Livewire\Component;

class Resuelto extends Component
{
    public $idTarea;
    public $tarea;

    public function render()
    {
        $this->tarea = TdriveTareas::find($this->idTarea);

        return view('livewire.tdrive.componentes.tareas.resuelto');
    }
}
