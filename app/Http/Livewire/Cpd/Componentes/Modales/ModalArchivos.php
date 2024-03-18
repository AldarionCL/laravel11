<?php

namespace App\Http\Livewire\Cpd\Componentes\Modales;

use App\Models\Cpd\ColorMarca;
use App\Models\Cpd\CpdArchivos;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdTareas;
use App\Models\Cpd\CpdTipos;
use App\Models\Cpd\Marca;
use App\Models\Cpd\Modelos;
use App\Models\Cpd\Vehiculos;
use App\Models\Cpd\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalArchivos extends ModalComponent
{

    public $idCpd;
    public $tareas;
    public array $arrayTareas;


    public function render()
    {
        $this->tareas = CpdTareas::where('CpdID',$this->idCpd)->orderBy('created_at','asc')->get();
        foreach ($this->tareas as $tarea)
        {
            $this->arrayTareas[$tarea->ID] = $tarea->Tipo->NombreTarea;
        }
        return view('livewire.cpd.componentes.modales.modal-archivos');
    }

    public function mount()
    {
        $this->tareas = CpdTareas::where('CpdID',$this->idCpd)->orderBy('created_at','asc')->get();
        $this->arrayTareas = CpdTareas::select(['CPD_Tareas.ID','NombreTarea'])
            ->join('CPD_Tipos','CPD_Tipos.ID','=','CPD_Tareas.CpdTipoID')
            ->where('CpdID',$this->idCpd)->orderBy('CpdTipoID','asc')->get()->toArray();
    }


}
