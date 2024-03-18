<?php

namespace App\Http\Livewire\Tdrive\Componentes\Tareas;

use App\Models\Cargo;
use App\Models\Tdrive\TdriveTareas;
use App\Models\Tdrive\TdriveTrabajos;
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
    public  $responsables;


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

        $this->camposValores = [
            'codigoOrdenCia',
            'horasDesabolladura',
            'piezasPreparado',
            'piezasPintura',
            'horasPlastico',
            'piezasPulido',
            'horasMecanica'
        ];
        $this->trabajos  = trabajosTDRIVE($this->tarea->TdriveID);
        $this->trabajosAdicionales = TdriveTareas::where('TdriveID',$this->tarea->TdriveID)->where('TdriveTipoID',20)->where('Estado','Resuelto')->get();
        $this->tareaOrdenCIA = TdriveTareas::where('TdriveID',$this->tarea->TdriveID)->where('TdriveTipoID',7)->where('Estado','Resuelto')->first();

        if( $this->tareaOrdenCIA)
        {

            // estimado inicial
            foreach($this->tareaOrdenCIA->Datos as $tareaOrdenCIA)
            {
                if( $tareaOrdenCIA->Campos->Campo== 'PDF orden')
                    continue;
                $this->valores["Estimado Inicial"][$tareaOrdenCIA->Campos->Campo] = $tareaOrdenCIA->Valor;
            }
            // valores adicionales
            foreach($this->trabajosAdicionales as $trabajosAdicionales) {
                foreach ($trabajosAdicionales->Datos as $trabajosAdicional) {
                    $this->valores["Adicional Orden: " . $trabajosAdicionales->ID][$trabajosAdicional->Campos->Campo] = $trabajosAdicional->Valor;
                }
            }
            // total
            foreach($this->valores as $llave => $valor)
            {
                foreach ($valor as $key => $val)
                {
                    $this->valores["Total"][$key] = (isset($this->valores["Total"][$key])) ? $this->valores["Total"][$key] + $val : $val;
                }
            }
        }


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
        ])->get()->toArray();

        $usuariosTdrive = UsuarioSucursal::select(['UsuarioID'])
            ->whereIn('CargoID', $cargosDYp)
            ->where('Activo', 1)
            ->pluck('UsuarioID')->toArray();


        $this->responsables = User::whereIn('ID',$usuariosTdrive)->get();

        //dd($this->valores);
        return view('livewire.tdrive.componentes.tareas.formulario-taller');
    }
}
