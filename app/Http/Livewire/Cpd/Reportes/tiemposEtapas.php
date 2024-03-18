<?php

namespace App\Http\Livewire\Cpd\Reportes;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdPasos;
use App\Models\Cpd\CpdTareas;
use Livewire\Component;


class tiemposEtapas extends Component
{
    public $pasos;
    public $iconos;
    public array $estados;
    public array $arrayCasos;
    public array $cantidades;

    public $idCpd;
    public $searchGerencia;
    public $searchSucursal;
    public $inputFechaInicio;
    public $inputFechaFin;

    public $listeners = ['updateDatatable','refreshComponent' => '$refresh'];

    public function render()
    {
        $this->pasos = CpdPasos::orderBy('Orden','asc')->get();
        $casos = [];
        $flujosCpd = CpdTareas::selectRaw('max(CPD_Tareas.ID) as IDTarea, CpdID, CPD_Tareas.ID, SucursalID, CPD_Tareas.created_at')
            ->join('CPD_Flujos','CPD_Flujos.ID','=','CPD_Tareas.CpdID')
            ->where('EstadoCpd' ,"Abierto")
            ->whereIn('CPD_Tareas.Estado',['Abierto','Postergado'])
            ->whereNull('CPD_Tareas.deleted_at')
            ->whereNull('CPD_Flujos.deleted_at')
            ->orderBy('CPD_Tareas.ID','desc')
            ->groupBy('CpdID');


        if(isset($this->searchSucursal) && ($this->searchSucursal) !='') {
            $flujosCpd = $flujosCpd->where('SucursalID', $this->searchSucursal);
        }
        if(isset($this->inputFechaInicio) && $this->inputFechaInicio != null) {
            $flujosCpd = $flujosCpd->where('CPD_Tareas.created_at', '>=', date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)));
        }
        if(isset($this->inputFechaFin) && $this->inputFechaFin != null) {
            $flujosCpd = $flujosCpd->where('CPD_Tareas.created_at', '<=', date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)));
        }

        $flujosCpd = $flujosCpd->get();

        foreach ($flujosCpd as $flujo) {
            $tarea = CpdTareas::find($flujo->IDTarea);
            $cpd = CpdFlujos::find($tarea->CpdID);
            $casos[$flujo->ID]["tiempototal"] = textoMinutos(MinutosEntreFechas(date('Y-m-d H:i:s'),$cpd->created_at ),true);
            $casos[$flujo->ID]["textotiempo"] = textoMinutos(MinutosEntreFechas(date('Y-m-d H:i:s'),$tarea->created_at ),true);
            $casos[$flujo->ID]["tiempo"] = (MinutosEntreFechas(date('Y-m-d H:i:s'),$tarea->created_at ));
            $casos[$flujo->ID]["patente"] = trim($cpd->Patente);
            $casos[$flujo->ID]["vin"] = trim($cpd->Vin);
            $casos[$flujo->ID]["etapa"] = $tarea->Tipo->Tipo;
            $casos[$flujo->ID]["NombreTarea"] = $tarea->Tipo->NombreTarea;
            $casos[$flujo->ID]["ID"] = $tarea->CpdID;
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

        return view('livewire.cpd.reportes.tiempos-etapas');
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
