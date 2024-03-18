<?php

namespace App\Http\Livewire\Tdrive\Componentes;

use App\Models\Clientes;
use App\Models\Tdrive\TdriveFlujos;
use Livewire\Component;


class DatosCliente extends Component
{

    public $idCliente;
    public $idTdrive;
    public $cliente;
    public $tdrive;

    public function render()
    {
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $this->cliente = Clientes::find($this->tdrive->ClienteID);

        return view('livewire.tdrive.componentes.datos-cliente');
    }
}
