<?php

namespace App\Exports\cpd;

use App\Models\Cpd\CpdFlujos;
use Maatwebsite\Excel\Concerns\FromCollection;

class exportComite implements FromCollection
{
    public $searchMarca;
    public $searchModelo;
    public $inputFechaInicio;
    public $inputFechaFin;
    public function __construct($searchMarca,$searchModelo,$inputFechaInicio,$inputFechaFin) {

        $this->searchMarca = $searchMarca;
        $this->searchModelo = $searchModelo;
        $this->inputFechaInicio = $inputFechaInicio;
        $this->inputFechaFin = $inputFechaFin;
    }

    public function collection()
    {
        $datos = CpdFlujos::join('CPD_Tareas','CPD_Flujos.ID','=','CPD_Tareas.CpdID')->where('CPD_Tareas.CpdTipoID', 16)->groupBy('CPD_Flujos.ID');

        if(isset($this->searchMarca) && ($this->searchMarca) !='') {
            $datos = $datos->where('Marca', $this->searchMarca);
        }
        if(isset($this->searchModelo) && ($this->searchModelo) !='') {
            $datos = $datos->where('Marca', $this->searchModelo);
        }
        if(isset($this->inputFechaInicio) && $this->inputFechaInicio != null) {
            $datos = $datos->where('created_at', '>=', date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)));
        }
        if(isset($this->inputFechaFin) && $this->inputFechaFin != null) {
            $datos = $datos->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)));
        }


        return $datos->get()->map(function($item) {
            return [
                'ID' => $item->ID,
                'EstadoCpd' => $item->EstadoCpd,
                'Marca' => $item->Marca,
                'Modelo' => $item->Modelo,
                'Patente' => $item->Patente,
                'Estado' => $item->Estado,
            ];
        });
    }

}
