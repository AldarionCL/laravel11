<?php

namespace App\Http\Livewire\Tdrive\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTareas;
use App\Models\Tdrive\TdriveTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalNuevaTarea extends ModalComponent
{

    public $idTdrive;
    public $tdrive;
    public $tareas;
    public $idTarea;
    public $tieneAsignacion;


    public function render()
    {
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $this->tieneAsignacion = TdriveTareas::where('TdriveID', $this->idTdrive)->where('TdriveTipoID',1)->first();

        return view('livewire.tdrive.componentes.modales.modal-nueva-tarea');
    }

    public function mount()
    {
        $this->tareas = TdriveTipos::where('PermiteCrear', 1)->get();
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $this->tieneAsignacion = TdriveTareas::where('TdriveID', $this->idTdrive)->where('TdriveTipoID',1)->first();

    }

}
