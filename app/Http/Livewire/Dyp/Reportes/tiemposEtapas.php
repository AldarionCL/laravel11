<?php

namespace App\Http\Livewire\Dyp\Reportes;

use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypPasos;
use App\Models\dyp\DypTareas;
use Livewire\Component;


class tiemposEtapas extends Component
{
    public $pasos;
    public $iconos;
    public array $estados;
    public array $arrayCasos;
    public array $cantidades;

    public $idDyp;
    public $searchGerencia;
    public $searchSucursal;
    public $inputFechaInicio;
    public $inputFechaFin;

    public $listeners = ['updateDatatable','refreshComponent' => '$refresh'];

    public function render()
    {
        $this->pasos = DypPasos::orderBy('Orden','asc')->get();
        $casos = [];
        $flujosDyp = DypTareas::selectRaw('max(DYP_Tareas.ID) as IDTarea, DypID, DYP_Tareas.ID, SucursalID, DYP_Tareas.created_at')
            ->join('DYP_Flujos','DYP_Flujos.ID','=','DYP_Tareas.DypID')
            ->whereIn('DYP_Tareas.Estado',['Abierto','Postergado'])
            ->whereNull('DYP_Tareas.deleted_at')
            ->whereNull('DYP_Flujos.deleted_at')
            ->orderBy('DYP_Tareas.ID','desc')
            ->groupBy('DypID');


        if(isset($this->searchSucursal) && ($this->searchSucursal) !='') {
            $flujosDyp = $flujosDyp->where('SucursalID', $this->searchSucursal);
        }
        if(isset($this->inputFechaInicio) && $this->inputFechaInicio != null) {
            $flujosDyp = $flujosDyp->where('DYP_Tareas.created_at', '>=', date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)));
        }
        if(isset($this->inputFechaFin) && $this->inputFechaFin != null) {
            $flujosDyp = $flujosDyp->where('DYP_Tareas.created_at', '<=', date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)));
        }

        $flujosDyp = $flujosDyp->get();

        foreach ($flujosDyp as $flujo) {
            $tarea = DypTareas::find($flujo->IDTarea);
            $dyp = DypFlujos::find($tarea->DypID);
            $casos[$flujo->ID]["tiempototal"] = textoMinutos(MinutosEntreFechas(date('Y-m-d H:i:s'),$dyp->created_at ),true);
            $casos[$flujo->ID]["textotiempo"] = textoMinutos(MinutosEntreFechas(date('Y-m-d H:i:s'),$tarea->created_at ),true);
            $casos[$flujo->ID]["tiempo"] = (MinutosEntreFechas(date('Y-m-d H:i:s'),$tarea->created_at ));
            $casos[$flujo->ID]["patente"] = trim($dyp->Patente);
            $casos[$flujo->ID]["vin"] = trim($dyp->Vin);
            $casos[$flujo->ID]["etapa"] = $tarea->Tipo->Tipo;
            $casos[$flujo->ID]["NombreTarea"] = $tarea->Tipo->NombreTarea;
            $casos[$flujo->ID]["ID"] = $tarea->DypID;
            $casos[$flujo->ID]["color"] = 'gray';
            if($casos[$flujo->ID]["tiempo"]>2880)
                $casos[$flujo->ID]["color"] = 'orange';
            if($casos[$flujo->ID]["tiempo"]>7200)
                $casos[$flujo->ID]["color"] = 'red';

        }

        foreach ($casos as $key => $row) {
            $aux[$key] = $row['tiempo'];
        }
        if(count($casos) > 0) array_multisort($aux, SORT_DESC, ($casos));

        foreach ($casos as $caso) {
            $this->arrayCasos[$caso["etapa"]][] = $caso;
            $this->cantidades[$caso["etapa"]] = (isset($this->cantidades[$caso["etapa"]])) ? $this->cantidades[$caso["etapa"]]+1 : 1;
        }
//dd($this->cantidades);
        $this->estados = array(
            '1'=> 'bg-blue-500' ,
            '2'=> 'bg-blue-500' ,
            '3'=> 'bg-blue-500' ,
            '4'=> 'bg-blue-500' ,
            '5'=> 'bg-blue-500' ,
            '6'=> 'bg-blue-500' ,
            '7'=> 'bg-blue-500' ,
            '8'=> 'bg-blue-500' ,
            '9'=> 'bg-blue-500' ,
            '10'=>'bg-blue-500' ,
            '11'=>'bg-blue-500' ,
            '12'=>'bg-blue-500' ,
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
            '12'=>'fa-file' ,
        );

        return view('livewire.dyp.reportes.tiempos-etapas');
    }

    public function updateDatatable($searchGerencia,$searchSucursal,$inputFechaInicio,$inputFechaFin): void
    {
        $this->searchGerencia = $searchGerencia;
        $this->searchSucursal = $searchSucursal;
        $this->inputFechaInicio = $inputFechaInicio;
        $this->inputFechaFin = $inputFechaFin;

        $this->emitTo('tiempos-etapas', 'refreshComponent');
        $this->emit('refreshComponent');
    }


}
