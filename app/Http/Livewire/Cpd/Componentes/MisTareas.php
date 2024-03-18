<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Cpd\CpdTareas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MisTareas extends Component
{
    public $idCpd;
    public $tareas;

    public function render()
    {
        $this->tareas = CpdTareas::where('ResponsableID',Auth::user()->ID)->whereNotIn('Estado',['Resuelto','Rechazado'])->get();

        return view('livewire.cpd.componentes.mis-tareas');
    }
}
