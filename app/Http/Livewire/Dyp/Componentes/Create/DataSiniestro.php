<?php

namespace App\Http\Livewire\Dyp\Componentes\Create;

use App\Models\Clientes;
use App\Models\dyp\ColorMarca;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use App\Models\Sucursales;
use Dompdf\Exception;
use Livewire\Component;

class DataSiniestro extends Component
{
    public $idVehiculo;
    public $inputMagnitud;
    public $inputNumPoliza;
    public $inputFechaEmision;
    public $inputTipoCliente;
    public $inputCiaSeguro;
    public $inputNumeroOT;
    public $inputSucursal;
    public $inputNumeroSiniestro;
    public $siniestroRequerido;

    public array $selectCiaSeguro;
    public array $selectSucursalServicio;
    public array $selectTipoCliente;

    public function render()
    {
        $this->siniestroRequerido = false;
        return view('livewire.dyp.componentes.create.data-siniestro');
    }

    public function updated()
    {
        if($this->inputTipoCliente === 'Particular')
        {
            $this->selectCiaSeguro = [['CiaSeguro' => 'Cliente DyP'],['CiaSeguro' => 'Interno Nuevo'],['CiaSeguro' => 'Interno CPD'],['CiaSeguro' => 'Interno Servicio']];
        }else
        {
            $this->siniestroRequerido = true;
            $this->selectCiaSeguro = [['CiaSeguro' => 'BCI'],['CiaSeguro' => 'Chilena Cons'],['CiaSeguro' => 'Consorcio'],['CiaSeguro' => 'HDI'],['CiaSeguro' => 'Mapfre'],['CiaSeguro' => 'Interno'],['CiaSeguro' => 'Particular'],['CiaSeguro' => 'Porvenir'],['CiaSeguro' => 'Reale'],['CiaSeguro' => 'Renta'],['CiaSeguro' => 'Zenit'],['CiaSeguro' => 'CARDIF'],['CiaSeguro' => 'ZURICH'],['CiaSeguro' => 'Libery']];
        }
        $this->emit('refreshComponent');
    }
    public function mount()
    {
        $this->inputFechaEmision = date('Y-m-d H:i');
        if($this->inputTipoCliente === 'Particular')
        {
            $this->selectCiaSeguro = [['CiaSeguro' => 'Cliente DyP'],['CiaSeguro' => 'Interno Nuevo'],['CiaSeguro' => 'Interno CPD'],['CiaSeguro' => 'Interno Servicio']];
        }else
        {
            $this->siniestroRequerido = true;
            $this->selectCiaSeguro = [['CiaSeguro' => 'BCI'],['CiaSeguro' => 'Chilena Cons'],['CiaSeguro' => 'Consorcio'],['CiaSeguro' => 'HDI'],['CiaSeguro' => 'Mapfre'],['CiaSeguro' => 'Interno'],['CiaSeguro' => 'Particular'],['CiaSeguro' => 'Porvenir'],['CiaSeguro' => 'Reale'],['CiaSeguro' => 'Renta'],['CiaSeguro' => 'Zenit'],['CiaSeguro' => 'CARDIF'],['CiaSeguro' => 'ZURICH'],['CiaSeguro' => 'Libery']];
        }
        $this->selectMagnitud = [['Magnitud' => 'Leve'],['Magnitud' => 'Media'],['Magnitud' => 'Grave'],['Magnitud' => 'Pérdida total']];
        $this->selectTipoCliente = [['TipoCliente' => 'Compañía'],['TipoCliente' => 'Particular']];
        $this->selectSucursalServicio = sucursales_servicio();
    }

}
