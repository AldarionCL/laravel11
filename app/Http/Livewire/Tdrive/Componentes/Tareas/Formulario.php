<?php

namespace App\Http\Livewire\Tdrive\Componentes\Tareas;

use App\Models\Tdrive\TdriveCampos;
use App\Models\Tdrive\TdriveDatosTarea;
use App\Models\Tdrive\TdriveTareas;
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
    public array $motivosPosterga;
    public array $motivosRechazo;

    public function __construct($id = null)
    {

    }

    public function render()
    {

        $this->tarea = TdriveTareas::find($this->idTarea);
        foreach($this->tarea->Tipo->Campos as $campo)
        {
            if($campo->Tipo != 'file')
                $this->inputs[] = $campo->InputName;
            else
                $this->files[] = $campo->InputName;
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

        return view('livewire.tdrive.componentes.tareas.formulario');
    }



}
