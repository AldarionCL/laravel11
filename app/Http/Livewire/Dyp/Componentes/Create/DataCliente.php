<?php

namespace App\Http\Livewire\Dyp\Componentes\Create;

use App\Models\Clientes;
use Dompdf\Exception;
use Livewire\Component;

class DataCliente extends Component
{
    public $idCliente;
    public $inputRutCliente;
    public $inputNombreCliente;
    public $inputApellidoCliente;
    public $inputEmailCliente;
    public $inputTelefonoCliente;
    public $inputTelefono2Cliente;
    public $inputTelefono3Cliente;

    public function render()
    {
        return view('livewire.dyp.componentes.create.data-cliente');
    }

    public function search()
    {
        try {

            $cliente = Clientes::where('Rut',$this->inputRutCliente)->first();
            if($cliente) {
                $this->inputNombreCliente = $cliente->Nombre;
                $this->inputApellidoCliente = $cliente->Apellido;
                $this->inputEmailCliente = $cliente->Email;
                $this->inputTelefonoCliente = $cliente->Telefono;
                $this->inputTelefono2Cliente = $cliente->Telefono2;
                $this->inputTelefono3Cliente = $cliente->Telefono3;
                $this->idCliente = $cliente->ID;

            }
            else
            {
                $this->inputNombreCliente = "";
                $this->inputApellidoCliente = "";
                $this->inputEmailCliente = "";
                $this->inputTelefonoCliente = "";
                $this->inputTelefonoCliente2 = "";
                $this->inputTelefonoCliente3 = "";
                $this->idCliente = "";
            }
            return view('livewire.dyp.componentes.create.data-cliente');

        }catch (Exception $e)
        {
            return view('livewire.dyp.componentes.create.data-cliente',[$e->getMessage()]);
        }
    }
}
