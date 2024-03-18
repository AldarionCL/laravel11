<?php

namespace App\Http\Livewire\Dyp\Componentes\Tareas;

use App\Models\dyp\DypTareas;
use Livewire\Component;

class Referencia extends Component
{
    public $idTarea;
    public $tarea;
    public $tareaRef;

    public function render()
    {
        $this->tarea = DypTareas::find($this->idTarea);
        if($this->tarea->TareaReferenciaID)
            $this->tareaRef = DypTareas::find($this->tarea->TareaReferenciaID);


        return view('livewire.dyp.componentes.tareas.referencia');
    }
}
