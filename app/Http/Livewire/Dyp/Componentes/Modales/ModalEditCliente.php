<?php
namespace App\Http\Livewire\Dyp\Componentes\Modales;

use App\Models\Clientes;
use App\Models\dyp\DypFlujos;
use App\Models\Sucursales;
use LivewireUI\Modal\ModalComponent;

class ModalEditCliente extends ModalComponent
{
    public $idDyp;
    public $idTarea;
    public $cliente;
    public $dyp;
    public $inputSucursal;

    public array $selectSucursal;

    public function render()
    {
        $this->dyp = DypFlujos::find($this->idDyp);
        $this->cliente = Clientes::find($this->dyp->ClienteID);

        return view('livewire.dyp.componentes.modales.modal-edit-cliente');
    }


    public function mount()
    {

        $this->dyp = DypFlujos::find($this->idDyp);

        $this->inputSucursal = $this->dyp->SucursalID;

        $this->selectSucursal = sucursales_servicio('todos');
    }
}


