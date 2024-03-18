<?php

namespace App\Http\Livewire\Tdrive\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Tdrive\TdriveArchivos;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTareas;
use App\Models\Tdrive\TdriveTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalArchivos extends ModalComponent
{

    public $idTdrive;
    public $tareas;
    public array $arrayTareas;

    public function render()
    {
        $this->tareas = TdriveTareas::where('TdriveID',$this->idTdrive)->orderBy('created_at','asc')->get();
        foreach ($this->tareas as $tarea)
        {
            $this->arrayTareas[$tarea->ID] = $tarea->Tipo->NombreTarea;
        }
        return view('livewire.tdrive.componentes.modales.modal-archivos');
    }

    public function mount()
    {
        $this->tareas = TdriveTareas::where('TdriveID',$this->idTdrive)->orderBy('created_at','asc')->get();
        $this->arrayTareas = TdriveTareas::select(['TDRIVE_Tareas.ID','NombreTarea'])
            ->join('TDRIVE_Tipos','TDRIVE_Tipos.ID','=','TDRIVE_Tareas.TdriveTipoID')
            ->where('TdriveID',$this->idTdrive)->orderBy('TdriveTipoID','asc')->get()->toArray();

    }


}
