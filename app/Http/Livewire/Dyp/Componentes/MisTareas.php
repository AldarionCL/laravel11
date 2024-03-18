<?php

namespace App\Http\Livewire\Dyp\Componentes;

use App\Models\dyp\DypTareas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MisTareas extends Component
{
    public $idDyp;
    public $tareas;

    public function render()
    {
        $this->tareas = DypTareas::where('ResponsableID',Auth::user()->ID)->whereNotIn('Estado',['Resuelto','Rechazado'])->get();

        return view('livewire.dyp.componentes.mis-tareas');
    }
}
