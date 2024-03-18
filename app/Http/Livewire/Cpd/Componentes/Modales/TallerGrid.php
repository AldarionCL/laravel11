<?php

namespace App\Http\Livewire\Cpd\Componentes\Modales;

use App\Models\Cpd\CpdFlujos;
use Livewire\Component;


class TallerGrid extends Component
{

    public $idCpd;
    public $puesto;
    public $cpd;
    public $tareas;
    public $idTarea;
    public $idSucursal;
    public $vehiculosTaller;

    public $matriz;
    public $filas;
    public $columnas;
    public $letras;
    public $titulos;

    public function render()
    {
        $this->filas = 50;
        $this->columnas = 12;

        $this->titulos = [
            '','Taller Dyp-','Taller Mecanica-','Inspección-','Lavado-','PPTO-','Acopio Dyp-','Acopio Mecánica-','Acopio Repuesto-','Acopio Reparacion-','Externo-','Mayoristas-','Judicial-'
        ];
        $this->letras = [
            '','A','B','C','D','E','F','G','H','I','J','K','L'
        ];

        $this->vehiculosTaller = CpdFlujos::whereNotNull('Cono');

        $this->vehiculosTaller = $this->vehiculosTaller->get();

        foreach ($this->vehiculosTaller as $vehiculo)
        {
            $this->matriz[$vehiculo->Cono]["patente"] = $vehiculo->Patente;
            $this->matriz[$vehiculo->Cono]["cpd"] = $vehiculo->ID;
        }

        return view('livewire.cpd.componentes.modales.taller-grid');
    }


    public function updatePosicion()
    {
        $puesto = CpdFlujos::where('Cono',$this->puesto)->count();

        $cpd = CpdFlujos::find($this->idCpd);
        $cpd->Cono = $puesto;
        $cpd->save();

        if($puesto == 0)
        {
            $cpd->save();
            return 'ok';
        }
        else
        {
            return 'utilizado';
        }

    }

}
