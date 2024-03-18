<?php

namespace App\Http\Livewire\Cpd\Componentes\Modales;

use App\Models\Cpd\ColorMarca;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\Marca;
use App\Models\Cpd\Modelos;
use App\Models\Cpd\Vehiculos;
use App\Models\Cpd\Versiones;
use App\Models\Sucursales;
use LivewireUI\Modal\ModalComponent;


class ModalEditSiniestro extends ModalComponent
{
    public $idCpd;
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


        return view('livewire.cpd.componentes.modales.modal-edit-siniestro');
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

        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->siniestro= CpdFlujos::find($this->idCpd);

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
