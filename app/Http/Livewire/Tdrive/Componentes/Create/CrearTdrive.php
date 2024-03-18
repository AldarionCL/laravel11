<?php

namespace App\Http\Livewire\Tdrive\Componentes\Create;

use Livewire\Component;
use Livewire\Request;

class CrearTdrive extends Component
{
    public $idCliente;
    public $inputRutCliente;
    public $inputNombreCliente;
    public $inputApellidoCliente;
    public $inputEmailCliente;
    public $inputTelefonoCliente;
    public $idVehiculo;
    public $inputMarca;
    public $inputModelo;
    public $inputVersion;
    public $inputColor;
    public $inputPatente;
    public $inputVin;
    public $inputMagnitud;
    public $inputNumPoliza;
    public $inputFechaEmision;
    public $inputPrimaNeta;
    public $inputCiaSeguro;
    public $inputNumeroOT;

    public array $selectCiaSeguro;
    public array $selectMarca;
    public array $selectModelo;
    public array $selectVersion;
    public array $selectColor;

    public function render()
    {
        return view('livewire.tdrive.componentes.create.crear-tdrive');
    }

}
