<?php

namespace App\Http\Livewire\Tdrive\Componentes\Create;

use App\Models\Clientes;
use App\Models\dyp\ColorMarca;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use Livewire\Component;

class DataVehiculo extends Component
{
    public $idVehiculo;
    public $inputMarca;
    public $inputModelo;
    public $inputColor;
    public $inputPatente;
    public $inputVin;

    public array $selectMarca;
    public array $selectModelo;
    public array $selectColor;

    public function render()
    {
        return view('livewire.tdrive.componentes.create.data-vehiculo');
    }

    public function mount()
    {
        $this->selectMarca = Marca::all()->toArray();
        $this->selectModelo = Modelos::all()->toArray();
        $this->selectColor = ColorMarca::all()->toArray();
    }

    public function search()
    {
        try {
            $vehiculo = Vehiculos::where('Patente',$this->inputPatente)->first();
            if($vehiculo) {
                $this->idVehiculo = $vehiculo->ID;
                $this->inputMarca = $vehiculo->MarcaID;
                $this->inputModelo = $vehiculo->ModeloID;
                $this->inputColor = $vehiculo->ColorID;
                $this->inputPatente = $vehiculo->Patente;
                $this->inputVin = $vehiculo->Vin;
            }
            else
            {
                $this->idVehiculo = "";
                $this->inputMarca = "";
                $this->inputModelo = "";
                $this->inputColor = "";
                $this->inputVin = "";
            }
            return view('livewire.tdrive.componentes.create.data-vehiculo');

        }catch (Exception $e)
        {
            return view('livewire.tdrive.componentes.create.data-vehiculo',[$e->getMessage()]);
        }
    }
}
