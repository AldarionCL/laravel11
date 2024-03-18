<?php

namespace App\Http\Livewire\Dyp\Componentes;

use App\Models\dyp\DypFlujos;
use Livewire\Component;

class DatosSiniestro extends Component
{
    public $idDyp;
    public $siniestro;
    public $dyp;

    public function render()
    {
        $this->siniestro= DypFlujos::find($this->idDyp);
        $this->dyp = DypFlujos::find($this->idDyp);

        return view('livewire.dyp.componentes.datos-siniestro');
    }
}
