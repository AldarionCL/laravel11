<?php

namespace App\Http\Livewire\Cpd\Componentes\Tareas;

use App\Models\Cpd\CpdCampos;
use App\Models\Cpd\CpdDatosTarea;
use App\Models\Cpd\CpdTareas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Formulario extends Component
{
    use WithFileUploads;
    public $idTarea;
    public $tarea;
    public $files = [];
    public $inputs = [];
    public $selects = [];
    public array $motivosPosterga;
    public array $motivosRechazo;

    public function __construct($id = null)
    {

    }

    public function render()
    {

        $this->tarea = CpdTareas::find($this->idTarea);
        foreach($this->tarea->Tipo->Campos as $campo)
        {
            if($campo->Tipo != 'file')
                $this->inputs[] = $campo->InputName;
            else
                $this->files[] = $campo->InputName;

            if($campo->Tipo != 'file')
                $this->selects[$campo->InputName] = $campo->InputName;
        }

        $this->motivosPosterga = array();
        foreach(explode(',',$this->tarea->Tipo->MotivosPostergacion) as $motivo)
        {
            $this->motivosPosterga[$motivo] = $motivo;
        }

        $this->motivosRechazo = array();
        foreach(explode(',',$this->tarea->Tipo->MotivosRechazo) as $motivo)
        {
            $this->motivosRechazo[$motivo] = $motivo;
        }

        return view('livewire.cpd.componentes.tareas.formulario');
    }



}
