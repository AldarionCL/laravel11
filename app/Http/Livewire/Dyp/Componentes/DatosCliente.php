<?php

namespace App\Http\Livewire\Dyp\Componentes;

use App\Models\Clientes;
use App\Models\dyp\DypFlujos;
use Livewire\Component;


class DatosCliente extends Component
{

    public $idCliente;
    public $idDyp;
    public $cliente;
    public $dyp;

    public function render()
    {
        $this->dyp = DypFlujos::find($this->idDyp);
        $this->cliente = Clientes::find($this->dyp->ClienteID);

        return view('livewire.dyp.componentes.datos-cliente');
    }
}
