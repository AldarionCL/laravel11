<?php

namespace App\Http\Livewire\Tdrive\Componentes\Tareas;

use App\Models\Tdrive\TdriveTareas;
use Livewire\Component;

class Referencia extends Component
{
    public $idTarea;
    public $tarea;
    public $tareaRef;

    public function render()
    {
        $this->tarea = TdriveTareas::find($this->idTarea);
        if($this->tarea->TareaReferenciaID)
            $this->tareaRef = TdriveTareas::find($this->tarea->TareaReferenciaID);


        return view('livewire.tdrive.componentes.tareas.referencia');
    }
}
