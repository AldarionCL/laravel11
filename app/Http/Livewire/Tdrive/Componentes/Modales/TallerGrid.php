<?php

namespace App\Http\Livewire\Tdrive\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Request;


class TallerGrid extends Component
{

    public $idTdrive;
    public $puesto;
    public $tdrive;
    public $tareas;
    public $idTarea;
    public $idSucursal;
    public $vehiculosTaller;

    public $matriz;
    public $filas;
    public $columnas;
    public $letras;

    public function render()
    {
        $this->filas = 20;
        $this->columnas = 10;

        $this->letras = [
            '','A','B','C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        ];

        $this->vehiculosTaller = TdriveFlujos::whereNotNull('Cono');

        if(isset($this->searchSucursal) && $this->searchSucursal != '') {
            $this->vehiculosTaller = $this->vehiculosTaller->where('SucursalID', $this->searchSucursal);
        }
        else{
            $this->vehiculosTaller = $this->vehiculosTaller->where('SucursalID',$this->idSucursal);
        }
        if(isset($this->inputFechaInicio) && $this->inputFechaInicio != null) {
            $this->vehiculosTaller = $this->vehiculosTaller->where('created_at', '>=', date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)));
        }
        if(isset($this->inputFechaFin) && $this->inputFechaFin != null) {
            $this->vehiculosTaller = $this->vehiculosTaller->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)));
        }

        $this->vehiculosTaller = $this->vehiculosTaller->get();

        foreach ($this->vehiculosTaller as $vehiculo)
        {
            $this->matriz[$vehiculo->Cono]["patente"] = $vehiculo->Vehiculo->Patente;
            $this->matriz[$vehiculo->Cono]["tdrive"] = $vehiculo->ID;
        }

        return view('livewire.tdrive.componentes.modales.taller-grid');
    }


}
