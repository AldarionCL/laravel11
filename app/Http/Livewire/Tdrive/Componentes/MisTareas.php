<?php

namespace App\Http\Livewire\Tdrive\Componentes;

use App\Models\Tdrive\TdriveTareas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MisTareas extends Component
{
    public $idTdrive;
    public $tareas;

    public function render()
    {
        $this->tareas = TdriveTareas::where('ResponsableID',Auth::user()->ID)->whereNotIn('Estado',['Resuelto','Rechazado'])->get();

        return view('livewire.tdrive.componentes.mis-tareas');
    }
}
