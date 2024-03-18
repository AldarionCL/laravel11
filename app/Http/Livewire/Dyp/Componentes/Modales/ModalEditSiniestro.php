<?php

namespace App\Http\Livewire\Dyp\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use App\Models\Sucursales;
use LivewireUI\Modal\ModalComponent;


class ModalEditSiniestro extends ModalComponent
{
    public $idDyp;
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


        return view('livewire.dyp.componentes.modales.modal-edit-siniestro');
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

        $this->dyp = DypFlujos::find($this->idDyp);
        $this->siniestro= DypFlujos::find($this->idDyp);

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
