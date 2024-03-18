<?php
namespace App\Http\Livewire\Cpd\Componentes\Modales;

use App\Models\Clientes;
use App\Models\Cpd\CpdFlujos;
use App\Models\Sucursales;
use LivewireUI\Modal\ModalComponent;

class ModalEditCliente extends ModalComponent
{
    public $idCpd;
    public $cliente;
    public $cpd;
    public $inputSucursal;

    public array $selectSucursal;

    public function render()
    {
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->cliente = Clientes::find($this->cpd->ClienteID);

        return view('livewire.cpd.componentes.modales.modal-edit-cliente');
    }


    public function mount()
    {

        $this->cpd = CpdFlujos::find($this->idCpd);

        $this->inputSucursal = $this->cpd->SucursalID;

        $this->selectSucursal = sucursales_servicio();
    }
}


