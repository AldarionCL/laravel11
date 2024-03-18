<?php

namespace App\Http\Livewire\Reception\Componentes;

use App\Models\Agendamientos;
use App\Models\Clientes;
use App\Models\Gerencias;
use App\Models\IntouchAgendamiento;
use App\Models\reception\Visitas;
use App\Models\Sucursales;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class ListaAgendamientos extends Component
{
    public $agendamientos;
    public  array $indicadores;
    public $searchGerencia;
    public $searchSucursal;
    public $inputFechaInicio;
    public $inputFechaFin;
    public $searchTipoAgenda;


    public $listeners = ['actualizaAgendamientos'];

    public function render()
    {
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'info',
            'message' => 'Filtrando...'
        ]);

        $data = array();
        $this->indicadores["asistencias"] = 0;
        $this->indicadores["retirados"] = 0;

        if( $this->searchGerencia == null && $this->searchSucursal== null && $this->inputFechaInicio== null && $this->inputFechaFin== null )
        {
            $this->agendamientos = array();
            $this->agendamientosIntouch = array();
        }else
        {
            // si no hay filtro fecha, muestra la fecha de hoy (para evitar sobrecarga de datos)
            ($this->inputFechaInicio!= null) ? $fechaIni = date('Y-m-d 00:00:01', strtotime($this->inputFechaInicio)) : $fechaIni = date('Y-m-d 00:00:01');
            ($this->inputFechaFin!= null) ? $fechaFin = date('Y-m-d 23:59:59', strtotime($this->inputFechaFin)) : $fechaFin = date('Y-m-d 23:59:59');

            // si solo filtraron fecha de inicio, la fecha fin es la de inicio al final del día
            if($this->inputFechaInicio!= null && $this->inputFechaFin= null)
                $fechaFin = date('Y-m-d 23:59:59', strtotime($fechaIni));


            $this->agendamientosIntouch = IntouchAgendamiento::where('fecha_agenda','>=',$fechaIni)
                ->where('fecha_agenda','<=',$fechaFin)
                //->where('estado',1)
                ->orderBy('fecha_agenda','asc');

            // filtros de gerencia y sucursal
            if($this->searchGerencia != null)
                $this->agendamientosIntouch = $this->agendamientosIntouch->whereIn('marca',$this->searchGerencia);
            if($this->searchSucursal != null)
                $this->agendamientosIntouch = $this->agendamientosIntouch->whereIn('sucursal',$this->searchSucursal);

            $this->agendamientosIntouch = $this->agendamientosIntouch->get();

            $this->agendamientos =  Agendamientos::join('SIS_AgendamientosTipos','SIS_AgendamientosTipos.ID','=','SIS_Agendamientos.TipoID')
                ->where('Inicio','>=', $fechaIni)
                ->where('Inicio','<=', $fechaFin)
                ->whereNotIn('TipoID',[63,56, 55, 65,])  // ignora los tipo Gestion propia segun comentario
                ->get();

            if($this->searchTipoAgenda != null)
                $this->agendamientos =  $this->agendamientos->whereIn('TipoID',$this->searchTipoAgenda);


            foreach($this->agendamientos as $agendamiento)
            {
                // si es de VT_Ventas
                if($agendamiento->MenuSecundarioID == 11)
                    $referencia = DB::connection('roma')->table('VT_Ventas')->where('ID',$agendamiento->ReferenciaID)->first();
                // si es de MK_Leads
                if($agendamiento->MenuSecundarioID == 2)
                    $referencia = DB::connection('roma')->table('MK_Leads')->where('ID',$agendamiento->ReferenciaID)->first();
                // si es de VT_Cotizaciones
                if($agendamiento->MenuSecundarioID == 9)
                    $referencia = DB::connection('roma')->table('VT_Cotizaciones')->where('ID',$agendamiento->ReferenciaID)->first();
                // si es de VT_Renovaciones
                if($agendamiento->MenuSecundarioID == 21)
                    $referencia = DB::connection('roma')->table('VT_Cotizaciones')->where('ID',$agendamiento->ReferenciaID)->first();
                // si es de CC_Optiman
                if($agendamiento->MenuSecundarioID == 22 || $agendamiento->MenuSecundarioID == 23 )
                    $referencia = DB::connection('roma')->table('CC_Optiman')->where('CC_Optiman.ID',$agendamiento->ReferenciaID)
                        ->join('VT_Ventas','VT_Ventas.ID','=','CC_Optiman.VentaID')->first();

                if(!$referencia)
                    continue;

                // Filtro de gerencia,  si el registro no está , lo salta
                if($this->searchGerencia != null && !in_array($referencia->MarcaID,$this->searchGerencia ))
                    continue;
                // Filtro de sucursal,  si el registro no está , lo salta
                if($this->searchSucursal != null && !in_array($referencia->SucursalID,$this->searchSucursal ))
                    continue;

                // asigna la gerencia y sucursal obtenida de la referencia
                $data["a".$agendamiento->ID]["SucursalID"] = @$referencia->SucursalID;
                $data["a".$agendamiento->ID]["Sucursal"] = @Sucursales::find($referencia->SucursalID)->Sucursal;
                $data["a".$agendamiento->ID]["MarcaID"] = @$referencia->MarcaID;
                $data["a".$agendamiento->ID]["Marca"] = @Gerencias::find($referencia->MarcaID)->Gerencia;

                $color ='text-success';
                if(date('H:i') > date('H:i' , strtotime($agendamiento->Termino.' -30 minutes')))
                    $color = 'text-warning';
                if(date('H:i') > date('H:i' , strtotime($agendamiento->Termino)))
                    $color = 'text-danger';

                $data["a".$agendamiento->ID]["Nombre"] = $agendamiento->Cliente->Nombre;
                $data["a".$agendamiento->ID]["Rut"] = $agendamiento->Cliente->Rut;
                $data["a".$agendamiento->ID]["Fecha_agenda"] = date('H:i' , strtotime($agendamiento->Inicio));
                $data["a".$agendamiento->ID]["Fecha_termino"] = date('H:i' , strtotime($agendamiento->Termino));
                $data["a".$agendamiento->ID]["Fecha"] = date('Y-m-d' , strtotime($agendamiento->Inicio));
                $data["a".$agendamiento->ID]["Servicio"] = $agendamiento->AgendamientoTipo->Tipo;
                $data["a".$agendamiento->ID]["Subtipo"] = $agendamiento->AgendamientoSubTipo->SubTipo;
                $data["a".$agendamiento->ID]["Comentario"] = $agendamiento->Comentario;
                $data["a".$agendamiento->ID]["ClienteID"] = $agendamiento->ClienteID;
                $data["a".$agendamiento->ID]["Color"] = $color;

                $visita = Visitas::where('ClienteID',$data["a".$agendamiento->ID]["ClienteID"])
                    ->where('FechaCreacion','>=',$fechaIni)
                    ->where('FechaCreacion','<=',$fechaFin)->orderBy('FechaCreacion','desc')
                    ->first();
                if($visita)
                {
                    if($visita->Fecha_salida != null)
                        $this->indicadores["retirados"]++;
                    else
                        $this->indicadores["asistencias"]++;


                }
            }

        }

        foreach($this->agendamientosIntouch as $agendamiento)
        {
            $color ='text-success';
            $termino = date('H:i' , strtotime($agendamiento->fecha_agenda.' +1 hour'));
            if(date('H:i') > date('H:i' , strtotime($termino.' -30 minutes')))
                $color = 'text-warning';
            if(date('H:i') > date('H:i' , strtotime($termino)))
                $color = 'text-danger';

            $cliente = Clientes::where('Rut',$agendamiento->rut)->first();

            $data["i".$agendamiento->ID]["Nombre"] = $agendamiento->nombres;
            $data["i".$agendamiento->ID]["Rut"] = $agendamiento->rut;
            $data["i".$agendamiento->ID]["Fecha_agenda"] = date('H:i' , strtotime($agendamiento->fecha_agenda));
            $data["i".$agendamiento->ID]["Fecha_termino"] = date('H:i' , strtotime($agendamiento->fecha_agenda.' +1 hour'));
            $data["i".$agendamiento->ID]["Fecha"] = date('Y-m-d' , strtotime($agendamiento->fecha_agenda));
            $data["i".$agendamiento->ID]["Patente"] = $agendamiento->patente;
            $data["i".$agendamiento->ID]["Servicio"] = $agendamiento->servicio_agendado;
            $data["i".$agendamiento->ID]["Subtipo"] = $agendamiento->tipo_servicio;
            $data["i".$agendamiento->ID]["Comentario"] = "Agendado con ".$agendamiento->recepcionista;
            ($cliente) ? $data["i".$agendamiento->ID]["ClienteID"] = $cliente->ID : $data["i".$agendamiento->ID]["ClienteID"] = null;
            $data["i".$agendamiento->ID]["Color"] = $color;
            $data["i".$agendamiento->ID]["SucursalID"] = $agendamiento->sucursal;
            $data["i".$agendamiento->ID]["Sucursal"] = $agendamiento->sucursal_txt;
            $data["i".$agendamiento->ID]["MarcaID"] = $agendamiento->marca;
            $data["i".$agendamiento->ID]["Marca"] = $agendamiento->marca_txt;

            if($data["i".$agendamiento->ID]["ClienteID"] != null)
            {
                $visita = Visitas::where('ClienteID',$data["i".$agendamiento->ID]["ClienteID"])
                    ->where('FechaCreacion','>=',$fechaIni)
                    ->where('FechaCreacion','<=',$fechaFin)->orderBy('FechaCreacion','desc')
                    ->first();

                if($visita)
                {
                    if($visita->Fecha_salida != null)
                        $this->indicadores["retirados"]++;
                    else
                        $this->indicadores["asistencias"]++;

                }

            }
        }

        $this->agendamientos = $data;

        $this->emit('actualizaIndicadores',count($data), $this->indicadores["retirados"],$this->indicadores["asistencias"]);


        return view('livewire.reception.componentes.lista-agendamientos');
    }

    public function mount()
    {

    }

    public function actualizaAgendamientos($searchGerencia,$searchSucursal,$inputFechaInicio,$inputFechaFin, $searchTipoAgenda): void
    {
        $this->searchGerencia = $searchGerencia;
        $this->searchSucursal = $searchSucursal;
        $this->inputFechaInicio = $inputFechaInicio;
        $this->inputFechaFin = $inputFechaFin;
        $this->searchTipoAgenda = $searchTipoAgenda;
        $this->indicadores["asistencias"] = 0;
        $this->indicadores["retirados"] = 0;

        $this->emit('refreshComponent');
    }
}


