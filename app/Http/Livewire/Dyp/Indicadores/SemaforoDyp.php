<?php

namespace App\Http\Livewire\Dyp\Indicadores;

use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypPasos;
use App\Models\dyp\DypTareas;
use Livewire\Component;


class SemaforoDyp extends Component
{
    public $pasos;
    public $iconos;
    public array $estados;

    public $idDyp;
    public function render()
    {
        $this->pasos = DypPasos::orderBy('Orden','asc')->whereNull('deleted_at')->get();
        $dyp = DypFlujos::find($this->idDyp);
        $tareas = DypTareas::select(['ID','DypTipoID','Estado'])
            ->where('DypID',$this->idDyp)
            ->whereNull('deleted_at')
            ->orderBy('Estado','Desc')
            ->get();

        $this->estados = array(
            '1'=>'bg-slate-500' ,
            '2'=>'bg-slate-500' ,
            '3'=>'bg-slate-500' ,
            '4'=>'bg-slate-500' ,
            '5'=>'bg-slate-500' ,
            '6'=>'bg-slate-500' ,
            '7'=>'bg-slate-500' ,
            '8'=>'bg-slate-500' ,
            '9'=>'bg-slate-500' ,
            '10'=>'bg-slate-500' ,
            '11'=>'bg-slate-500' ,
        );
        $this->iconos = array(
            '1'=>'fa-check-circle' ,
            '2'=>'fa-address-book-o' ,
            '3'=>'fa-handshake-o' ,
            '4'=>'fa-money' ,
            '5'=>'fa-file-text-o' ,
            '6'=>'fa-briefcase' ,
            '7'=>'fa-wrench' ,
            '8'=>'fa-wrench' ,
            '9'=>'fa-car' ,
            '10'=>'fa-handshake-o' ,
            '11'=>'fa-file' ,
        );

        foreach($tareas as $tarea)
        {


            if($tarea->Estado == 'Resuelto')
            {
                $this->estados[$tarea->Tipo->Tipo] = 'bg-green-500';
            }

            if($tarea->Estado == 'Postergado')
            {
                $this->estados[$tarea->Tipo->Tipo] = 'bg-yellow-500';
            }

            if($tarea->Estado == 'Rechazado')
            {
                $this->estados[$tarea->Tipo->Tipo] = 'bg-red-500';
            }

            if($tarea->Estado == 'Abierto')
            {
                $this->estados[$tarea->Tipo->Tipo] = 'bg-orange-500';
            }
        }



        return view('livewire.dyp.indicadores.semaforo-dyp');
    }
}
