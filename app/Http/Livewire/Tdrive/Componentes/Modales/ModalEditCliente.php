<?php
namespace App\Http\Livewire\Tdrive\Componentes\Modales;

use App\Models\Clientes;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Sucursales;
use LivewireUI\Modal\ModalComponent;

class ModalEditCliente extends ModalComponent
{
    public $idTdrive;
    public $cliente;
    public $tdrive;
    public $inputSucursal;

    public array $selectSucursal;

    public function render()
    {
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $this->cliente = Clientes::find($this->tdrive->ClienteID);

        return view('livewire.tdrive.componentes.modales.modal-edit-cliente');
    }


    public function mount()
    {

        $this->tdrive = TdriveFlujos::find($this->idTdrive);

        $this->inputSucursal = $this->tdrive->SucursalID;

        $this->selectSucursal = sucursales_servicio('todos');
    }
}


