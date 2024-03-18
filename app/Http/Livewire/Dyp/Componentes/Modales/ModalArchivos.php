<?php

namespace App\Http\Livewire\Dyp\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\dyp\DypArchivos;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypTareas;
use App\Models\dyp\DypTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalArchivos extends ModalComponent
{

    public $idDyp;
    public $tareas;
    public array $arrayTareas;

    public function render()
    {
        $this->tareas = DypTareas::where('DypID',$this->idDyp)->orderBy('created_at','asc')->get();
        foreach ($this->tareas as $tarea)
        {
            $this->arrayTareas[$tarea->ID] = $tarea->Tipo->NombreTarea;
        }
        return view('livewire.dyp.componentes.modales.modal-archivos');
    }

    public function mount()
    {
        $this->tareas = DypTareas::where('DypID',$this->idDyp)->orderBy('created_at','asc')->get();
        $this->arrayTareas = DypTareas::select(['DYP_Tareas.ID','NombreTarea'])
            ->join('DYP_Tipos','DYP_Tipos.ID','=','DYP_Tareas.DypTipoID')
            ->where('DypID',$this->idDyp)->orderBy('DypTipoID','asc')->get()->toArray();

    }


}
