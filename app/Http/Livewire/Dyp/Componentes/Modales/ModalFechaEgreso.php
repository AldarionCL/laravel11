<?php

namespace App\Http\Livewire\Dyp\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypTareas;
use App\Models\dyp\DypTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalFechaEgreso extends ModalComponent
{

    public $idDyp;
    public $dyp;
    public $tareas;
    public $idTarea;
    public $tieneAsignacion;


    public function render()
    {
        $this->dyp = DypFlujos::find($this->idDyp);
        $this->tieneAsignacion = DypTareas::where('DypID', $this->idDyp)->where('DypTipoID',1)->first();

        return view('livewire.dyp.componentes.modales.modal-fecha-egreso');
    }

    public function mount()
    {
        $this->tareas = DypTipos::where('PermiteCrear', 1)->get();
        $this->dyp = DypFlujos::find($this->idDyp);
        $this->tieneAsignacion = DypTareas::where('DypID', $this->idDyp)->where('DypTipoID',1)->first();

    }

}
