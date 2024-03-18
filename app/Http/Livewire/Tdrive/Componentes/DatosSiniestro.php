<?php

namespace App\Http\Livewire\Tdrive\Componentes;

use App\Models\Tdrive\TdriveFlujos;
use Livewire\Component;

class DatosSiniestro extends Component
{
    public $idTdrive;
    public $siniestro;
    public $tdrive;

    public function render()
    {
        $this->siniestro= TdriveFlujos::find($this->idTdrive);
        $this->tdrive = TdriveFlujos::find($this->idTdrive);

        return view('livewire.tdrive.componentes.datos-siniestro');
    }
}
