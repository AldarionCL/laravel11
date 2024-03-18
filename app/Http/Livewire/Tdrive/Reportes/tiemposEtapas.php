<?php

namespace App\Http\Livewire\Tdrive\Reportes;

use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdrivePasos;
use App\Models\Tdrive\TdriveTareas;
use Livewire\Component;


class tiemposEtapas extends Component
{
    public $pasos;
    public $iconos;
    public array $estados;
    public array $arrayCasos;
    public array $cantidades;

    public $idTdrive;
    public $searchGerencia;
    public $searchSucursal;
    public $inputFechaInicio;
    public $inputFechaFin;

    public $listeners = ['updateDatatable','refreshComponent' => '$refresh'];

    public function render()
    {
        $this->pasos = TdrivePasos::orderBy('Orden','asc')->get();
        $casos = [];
        $flujosTdrive = TdriveTareas::selectRaw('max(TDRIVE_Tareas.ID) as IDTarea, TdriveID, TDRIVE_Tareas.ID, SucursalID, TDRIVE_Tareas.created_at')
            ->join('TDRIVE_Flujos','TDRIVE_Flujos.ID','=','TDRIVE_Tareas.TdriveID')
            ->whereIn('TDRIVE_Tareas.Estado',['Abierto','Postergado'])
            ->whereNull('TDRIVE_Tareas.deleted_at')
            ->whereNull('TDRIVE_Flujos.deleted_at')
            ->orderBy('TDRIVE_Tareas.ID','desc')
            ->groupBy('TdriveID');


        if(isset($this->searchSucursal) && ($this->searchSucursal) !='') {
            $flujosTdrive = $flujosTdrive->where('SucursalID', $this->searchSucursal);
        }
        if(isset($this->inputFechaInicio) && $this->inputFechaInicio != null) {
            $flujosTdrive = $flujosTdrive->where('TDRIVE_Tareas.created_at', '>=', date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)));
        }
        if(isset($this->inputFechaFin) && $this->inputFechaFin != null) {
            $flujosTdrive = $flujosTdrive->where('TDRIVE_Tareas.created_at', '<=', date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)));
        }

        $flujosTdrive = $flujosTdrive->get();

        foreach ($flujosTdrive as $flujo) {
            $tarea = TdriveTareas::find($flujo->IDTarea);
            $tdrive = TdriveFlujos::find($tarea->TdriveID);
            $casos[$flujo->ID]["tiempototal"] = textoMinutos(MinutosEntreFechas(date('Y-m-d H:i:s'),$tdrive->created_at ),true);
            $casos[$flujo->ID]["textotiempo"] = textoMinutos(MinutosEntreFechas(date('Y-m-d H:i:s'),$tarea->created_at ),true);
            $casos[$flujo->ID]["tiempo"] = (MinutosEntreFechas(date('Y-m-d H:i:s'),$tarea->created_at ));
            $casos[$flujo->ID]["patente"] = trim($tdrive->Patente);
            $casos[$flujo->ID]["vin"] = trim($tdrive->Vin);
            $casos[$flujo->ID]["etapa"] = $tarea->Tipo->Tipo;
            $casos[$flujo->ID]["NombreTarea"] = $tarea->Tipo->NombreTarea;
            $casos[$flujo->ID]["ID"] = $tarea->TdriveID;
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

        return view('livewire.tdrive.reportes.tiempos-etapas');
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
