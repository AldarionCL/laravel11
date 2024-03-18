<?php

namespace App\Http\Livewire\Cpd\Indicadores;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdPasos;
use App\Models\Cpd\CpdTareas;
use Livewire\Component;


class SemaforoCpd extends Component
{
    public $pasos;
    public $iconos;
    public array $estados;

    public $idCpd;
    public function render()
    {
        $this->pasos = CpdPasos::orderBy('Orden','asc')->get();
        $cpd = CpdFlujos::find($this->idCpd);
        $tareas = CpdTareas::select(['ID','CpdTipoID','Estado'])
            ->where('CpdID',$this->idCpd)
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
            '1'=>'fa-address-book-o' ,
            '2'=>'fa-check-circle' ,
            '3'=>'fa-list-alt' ,
            '4'=>'fa-wrench' ,
            '5'=>'fa-briefcase' ,
            '6'=>'fa-thumbs-up' ,
            '7'=>'fa-exchange' ,
            '8'=>'fa-handshake-o' ,
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



        return view('livewire.cpd.indicadores.semaforo-cpd');
    }
}
