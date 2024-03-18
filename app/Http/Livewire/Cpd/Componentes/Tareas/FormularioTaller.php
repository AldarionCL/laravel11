<?php

namespace App\Http\Livewire\Cpd\Componentes\Tareas;

use App\Models\Cargo;
use App\Models\Cpd\CpdTareas;
use App\Models\Cpd\CpdTipos;
use App\Models\Cpd\CpdTrabajos;
use App\Models\User;
use App\Models\UsuarioSucursal;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormularioTaller extends Component
{
    use WithFileUploads;
    public $idTarea;
    public $tarea;
    public $files = [];
    public $inputs = [];
    public $trabajos = [];
    public array $motivosPosterga;
    public array $motivosRechazo;
    public  $campoValores;
    public $trabajosAdicionales;
    public $tareaOrdenCIA;
    public array $valores;
    public $responsables;


    public function render()
    {
        $this->tarea = CpdTareas::find($this->idTarea);
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

        // tareas de tipo wip
        $wips = CpdTipos::where('Requerimiento','WIP')->pluck('ID');
        $this->trabajos = CpdTareas::where('CpdID', $this->tarea->CpdID)
            ->whereIn('CpdTipoID',$wips)
            ->get();

        $cargosDYp = Cargo::select(['ID'])->whereIn('Cargo',[
            'AUXILIAR DE ASEO',
            'COLORISTA',
            'DESABOLLADOR',
            'DESARMADOR/ARMADOR',
            'INSTALADOR',
            'JEFE DE PATIO',
            'MECANICO',
            'PINTOR',
            'PLASTIQUERO',
            'PREPARADOR',
            'PULIDOR',
            'TERMINADOR',
            'TORRE DE CONTROL',
            'LAVADOR',
        ])->get()->pluck('ID');

        $usuariosDyp = UsuarioSucursal::select(['UsuarioID'])
            ->whereIn('CargoID', $cargosDYp)
            ->where('Activo', 1)
            ->get()->pluck('UsuarioID');

        $this->responsables = User::whereIn('ID',$usuariosDyp)->get();

        //dd($this->valores);
        return view('livewire.cpd.componentes.tareas.formulario-taller');
    }
}
