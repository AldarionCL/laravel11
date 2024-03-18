<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Clientes;
use App\Models\Cpd\CpdFlujos;
use Livewire\Component;


class DatosCliente extends Component
{

    public $idCliente;
    public $idCpd;
    public $cliente;
    public $cpd;

    public function render()
    {
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->cliente = Clientes::find($this->cpd->ClienteID);

        return view('livewire.cpd.componentes.datos-cliente');
    }
}
