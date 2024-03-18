<?php

namespace App\Http\Livewire\Tdrive\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use App\Models\Sucursales;
use LivewireUI\Modal\ModalComponent;


class ModalEditSiniestro extends ModalComponent
{
    public $idTdrive;
    public $siniestro;
    public $inputMagnitud;
    public $inputTipoCliente;
    public $inputCiaSeguro;
    public $inputOT;
    public $inputSiniestro;

    public array $selectTipoCliente;
    public array $selectCiaSeguro;
    public array $selectMagnitud;
    public array $selectSucursalServicio;

    public function render()
    {


        return view('livewire.tdrive.componentes.modales.modal-edit-siniestro');
    }

    public function updated()
    {
        if($this->inputTipoCliente === 'Particular')
        {
            $this->selectCiaSeguro = [['CiaSeguro' => 'Cliente DyP'],['CiaSeguro' => 'Interno Nuevo'],['CiaSeguro' => 'Interno CPD'],['CiaSeguro' => 'Interno Servicio']];
        }else
        {
            $this->selectCiaSeguro = [['CiaSeguro' => 'BCI'],['CiaSeguro' => 'Chilena Cons'],['CiaSeguro' => 'Consorcio'],['CiaSeguro' => 'HDI'],['CiaSeguro' => 'Mapfre'],['CiaSeguro' => 'Interno'],['CiaSeguro' => 'Particular'],['CiaSeguro' => 'Porvenir'],['CiaSeguro' => 'Reale'],['CiaSeguro' => 'Renta'],['CiaSeguro' => 'Zenit']];
        }
        $this->emit('refreshComponent');
    }
    public function mount()
    {

        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $this->siniestro= TdriveFlujos::find($this->idTdrive);

        $this->inputMagnitud = $this->siniestro->Magnitud;
        $this->inputTipoCliente = $this->siniestro->TipoCliente;
        $this->inputCiaSeguro = $this->siniestro->CompaniaSeguro;
        $this->inputOT = $this->siniestro->Ot_principal;
        $this->inputSiniestro = $this->siniestro->NumeroSiniestro;


        if($this->inputTipoCliente === 'Particular')
        {
            $this->selectCiaSeguro = [['CiaSeguro' => 'Cliente DyP'],['CiaSeguro' => 'Interno Nuevo'],['CiaSeguro' => 'Interno CPD'],['CiaSeguro' => 'Interno Servicio']];
        }else
        {
            $this->selectCiaSeguro = [['CiaSeguro' => 'BCI'],['CiaSeguro' => 'Chilena Cons'],['CiaSeguro' => 'Consorcio'],['CiaSeguro' => 'HDI'],['CiaSeguro' => 'Mapfre'],['CiaSeguro' => 'Interno'],['CiaSeguro' => 'Particular'],['CiaSeguro' => 'Porvenir'],['CiaSeguro' => 'Reale'],['CiaSeguro' => 'Renta'],['CiaSeguro' => 'Zenit']];
        }
        $this->selectMagnitud = [['Magnitud' => 'Leve'],['Magnitud' => 'Media'],['Magnitud' => 'Grave'],['Magnitud' => 'Pérdida total']];
        $this->selectTipoCliente = [['TipoCliente' => 'Compañía'],['TipoCliente' => 'Particular']];
        $this->selectSucursalServicio = sucursales_servicio();
    }


}
