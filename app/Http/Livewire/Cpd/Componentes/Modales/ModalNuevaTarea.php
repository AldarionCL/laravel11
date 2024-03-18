<?php

namespace App\Http\Livewire\Cpd\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdTareas;
use App\Models\Cpd\CpdTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalNuevaTarea extends ModalComponent
{

    public $idCpd;
    public $cpd;
    public $tareas;
    public $idTarea;
    public $tieneAsignacion;


    public function render()
    {
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->tieneAsignacion = CpdTareas::where('CpdID', $this->idCpd)->where('CpdTipoID',1)->first();

        return view('livewire.cpd.componentes.modales.modal-nueva-tarea');
    }

    public function mount()
    {
        $this->tareas = CpdTipos::where('PermiteCrear', 1)->get();
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->tieneAsignacion = CpdTareas::where('CpdID', $this->idCpd)->where('CpdTipoID',1)->first();

    }

}
