<?php

namespace App\Http\Livewire\Cpd\Componentes\Tareas;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdTareas;
use Livewire\Component;

class Referencia extends Component
{
    public $idTarea;
    public $tarea;
    public $tareaRef;
    public $cpd;

    public function render()
    {
        $this->tarea = CpdTareas::find($this->idTarea);
        $this->cpd = CpdFlujos::find($this->tarea->CpdID);
        if($this->tarea->TareaReferenciaID)
            $this->tareaRef = CpdTareas::find($this->tarea->TareaReferenciaID);


        return view('livewire.cpd.componentes.tareas.referencia');
    }
}
