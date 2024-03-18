<?php

namespace App\Http\Livewire\Kpi\Buscadores;

use App\Models\dyp\Seguros;
use App\Models\Kpi\Cotizaciones;
use App\Models\Kpi\Inscripciones;
use App\Models\Kpi\Ventas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tablakpi extends Component
{
    public $searchGerencia;
    public $searchSucursal;
    public $searchVendedores;
    public $searchMarca;
    public $searchTipoVenta;
    public $searchModelo;
    public $searchCanal;
    public $searchCierre;
    public $searchCupon;
    public $searchOficina;
    public $searchUnidadNegocio;
    public $inputFechaInicio;
    public $inputFechaFin;

    public $listeners = ['updateTablaKpi'];

    public array $datos;

    public function render()
    {

        if($this->inputFechaInicio == '')
            $this->inputFechaInicio = date('Y-m-01', strtotime(date('Y-m-d')));
        if($this->inputFechaFin == '')
            $this->inputFechaFin = date('Y-m-d');

        //dd($this->inputFechaInicio,$this->inputFechaFin);
            $filtros["searchUnidadNegocio"] = $this->searchUnidadNegocio;
            $filtros["searchGerencia"] = $this->searchGerencia;
            $filtros["searchSucursal"] = $this->searchSucursal;
            $filtros["searchVendedores"] = $this->searchVendedores;
            $filtros["searchMarca"] = $this->searchMarca;
            $filtros["searchTipoVenta"] = $this->searchTipoVenta;
            $filtros["searchModelo"] = $this->searchModelo;
            $filtros["searchCanal"] = $this->searchCanal;
            $filtros["searchCierre"] = $this->searchCierre;
            $filtros["searchCupon"] = $this->searchCupon;
            $filtros["searchOficina"] = $this->searchOficina;
            $filtros["searchFechaInicio"] = $this->inputFechaInicio;
            $filtros["searchFechaFin"] = $this->inputFechaFin;


        // Inicio de Querys

        $filtros["campoFecha"] = 'FechaFactura';
        $this->datos[1] = Ventas::FiltrosKPI($filtros)->where('EstadoVentaID',4)
            ->whereBetween('FechaVenta',[date('Y-m-d H:i',strtotime($this->inputFechaInicio)),date('Y-m-d H:i',strtotime($this->inputFechaFin))])
            ->count();

        $filtros["campoFecha"] = 'FechaVenta';
        $this->datos[2] = Ventas::FiltrosKPI($filtros)->where('EstadoVentaID',1)
            ->count();

        $this->datos[0]=  $this->datos[1] + $this->datos[2];

        $filtros["campoFecha"] = 'FechaVenta';
        $this->datos[3] = $this->datos[2] / date('d',strtotime(date('Y-m-d').'-1 day')) * date('t',strtotime(date('Y-m-d'))) ;

        $filtros["campoFecha"] = 'VT_Inscripciones.FechaInscripcion';
        $this->datos[5] = Ventas::FiltrosKPI($filtros)
            ->join('VT_Inscripciones','VT_Inscripciones.VentaID','=','VT_Ventas.ID')->count();

        return view('livewire.kpi.buscadores.tablakpi');
    }

    public function updateTablaKpi($searchGerencia, $searchSucursal, $searchVendedores, $searchMarca, $searchTipoVenta, $searchModelo, $searchCanal, $searchCierre, $searchCupon, $searchOficina, $inputFechaInicio, $inputFechaFin)
    {

        $this->searchGerencia = (is_array($searchGerencia))? implode(',',$searchGerencia) : $searchGerencia;
        $this->searchSucursal = (is_array($searchSucursal))? implode(',',$searchSucursal) : $searchSucursal;
        $this->searchVendedores = (is_array($searchVendedores))? implode(',',$searchVendedores) : $searchVendedores;
        $this->searchMarca = (is_array($searchMarca))? implode(',',$searchMarca) : $searchMarca;
        $this->searchTipoVenta = (is_array($searchTipoVenta))? implode(',',$searchTipoVenta) : $searchTipoVenta;
        $this->searchModelo = (is_array($searchModelo))? implode(',',$searchModelo) : $searchModelo;
        $this->searchCanal = (is_array($searchCanal))? implode(',',$searchCanal) : $searchCanal;
        $this->searchCierre = (is_array($searchCierre))? implode(',',$searchCierre) : $searchCierre;
        $this->searchCupon = (is_array($searchCupon))? implode(',',$searchCupon) : $searchCupon;
        $this->searchOficina = (is_array($searchOficina))? implode(',',$searchOficina) : $searchOficina;
        $this->inputFechaInicio = (is_array($inputFechaInicio))? implode(',',$inputFechaInicio) : $inputFechaInicio;
        $this->inputFechaFin = (is_array($inputFechaFin))? implode(',',$inputFechaFin) : $inputFechaFin;

        //$this->emit('refreshComponent');
    }

    public function mount()
    {



       /* // preparacion de query
        if($this->inputFechaInicio == null)
            $this->inputFechaInicio = date('Y-m-d', strtotime('-7 month'));
        if($this->inputFechaFin == null)
            $this->inputFechaFin = date('Y-m-d');


        $varActaEntregaCargada = Ventas::FiltrosKPI(
            $this->searchUnidadNegocio,
            $this->searchGerencia,
            $this->searchSucursal,
            $this->searchVendedores,
            $this->searchMarca,
            $this->searchTipoVenta,
            $this->searchModelo,
            $this->searchCanal,
            $this->searchCierre,
            $this->searchCupon,
            $this->searchOficina,
            'VT_Ventas.FechaActaEntrega',
            $this->inputFechaInicio,
            $this->inputFechaFin
        )
            ->where('EstadoVentaID',4)
            ->where('EstadoActaEntregaID',2)
            ->whereRaw('if( MA_Sucursales.GerenciaID <> 10, VT_Ventas.TransferenciaOtroConsecionario = 0, VT_Ventas.TransferenciaOtroConsecionario in (1, 0))')
            ->count();


        $varActaEntregaPendiente = Ventas::FiltrosKpi(
            $this->searchUnidadNegocio,
            $this->searchGerencia,
            $this->searchSucursal,
            $this->searchVendedores,
            $this->searchMarca,
            $this->searchTipoVenta,
            $this->searchModelo,
            $this->searchCanal,
            $this->searchCierre,
            $this->searchCupon,
            $this->searchOficina,
            'VT_Ventas.FechaFactura',
            $this->inputFechaInicio,
            $this->inputFechaFin
        )
            ->leftjoin('SIS_StockFull','SIS_StockFull.VIN','=','VT_Ventas.Vin')
            ->where('EstadoVentaID',4)
            ->whereIn('EstadoActaEntregaID',[0,1])
            ->whereRaw('if( MA_Sucursales.GerenciaID <> 10, VT_Ventas.TransferenciaOtroConsecionario = 0, VT_Ventas.TransferenciaOtroConsecionario in (1, 0))')
            ->count();


        $cotizaciones = Cotizaciones::FiltrosKpi(
            $this->searchUnidadNegocio,
            $this->searchGerencia,
            $this->searchSucursal,
            $this->searchVendedores,
            $this->searchMarca,
            $this->searchModelo,
            $this->searchCanal,
            'VT_Cotizaciones.FechaCotizacion',
            $this->inputFechaInicio,
            $this->inputFechaFin
        );

        $cotizacionesL2 = $cotizaciones->select([
                db::raw(' count(*) as Total'),
                db::raw(' sum(if(VT_Cotizaciones.EstadoID<>1,1,0)) as SolCredito'),
                db::raw(' sum(if(VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5),1,0)) as Aprobados'),
                db::raw(' sum(if(VT_Cotizaciones.EstadoID=3,1,0)) as Rechazados'),
                db::raw(' sum(if(VT_Cotizaciones.VisibleSegundas=1,1,0)) as SolCreditoSegundas'),
                db::raw(' sum(if(VT_Cotizaciones.Venta=1,1,0)) as Ventas'),
                db::raw(' sum(if(VT_Cotizaciones.Vendido=1,1,0)) as Vendidos'),
                db::raw(' sum(if(MA_Sucursales.GerenciaID in(1,2,5,11,12,14) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5),1,if(MA_Sucursales.GerenciaID in(3) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5),1,if(MA_Sucursales.GerenciaID in(13) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5),1,if(MA_Sucursales.GerenciaID in(4) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5),1,0))))) as AprobPrimeraOp'),
                db::raw(' sum(if(MA_Sucursales.GerenciaID in(1,2,5,11,12,14) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5) and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(3) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,5) and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(13) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5) and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(4) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5) and VT_Cotizaciones.VisibleSegundas=1,1,0))))) as AprobSegundaOp'),
                db::raw(' sum(if(MA_Sucursales.GerenciaID in(1,2,5,11,12,14) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5) and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(3) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,5) and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(13) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5) and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(4) and VT_Cotizaciones.EstadoID in(2,8,9,7,10,11,5) and VT_Cotizaciones.VisibleSegundas=1,1,0))))) as AprobOtrasOp'),
                db::raw(' sum(if(MA_Sucursales.GerenciaID in(1,2,5,11,12,14) and VT_Cotizaciones.EstadoID<>1,1,if(MA_Sucursales.GerenciaID in(3) and VT_Cotizaciones.EstadoID<>1,1,if(MA_Sucursales.GerenciaID in(13) and VT_Cotizaciones.EstadoID<>1,1,if(MA_Sucursales.GerenciaID in(4) and VT_Cotizaciones.EstadoID<>1,1,0))))) as SolPrimeraOp'),
                db::raw(' sum(if(MA_Sucursales.GerenciaID in(1,2,5,11,12,14) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(3) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(13) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(4) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,0))))) as SolSegundaOp'),
                db::raw(' sum(if(MA_Sucursales.GerenciaID in(1,2,5,11,12,14) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(3) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(13) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,if(MA_Sucursales.GerenciaID in(4) and VT_Cotizaciones.EstadoID<>1 and VT_Cotizaciones.VisibleSegundas=1,1,0))))) as SolOtrasO')
            ]
        )->groupBy('VT_Cotizaciones.ConcatAnterior')->get()->toArray();

        $cotizacionesCanal =  $cotizaciones->select([
                db::raw(' count(*) as Total'),
                'VT_Cotizaciones.CanalID','VT_Cotizaciones.Canal'
            ]
        )
            ->join('MA_Canales','MA_Canales.ID','=','VT_Cotizaciones.CanalID')
            ->groupBy('VT_Cotizaciones.CanalID')->get()->toArray();


        // Seguros
        $seguros = Seguros::select(
            db::raw('sum(if(VT_Seguros.FormaPago="(en blanco)",1,if(VT_Seguros.FormaPago="MULTIANUAL",1,0))) as MultiAnual'),
            db::raw('sum(if(VT_Seguros.FormaPago="PAC",1,0)) as Pac'),
            db::raw('sum(if(VT_Seguros.FormaPago="PAT",1,0)) as Pat'),
            db::raw('sum(if(VT_Seguros.Deducible="0",1,0)) as Deducible0'),
            db::raw('sum(if(VT_Seguros.Deducible="3",1,0)) as Deducible3'),
            db::raw('sum(if(VT_Seguros.Deducible="5",1,0)) as Deducible5'),
            db::raw('sum(if(VT_Seguros.Deducible="7",1,0)) as Deducible7'),
            db::raw('sum(if(VT_Seguros.Deducible="10",1,0)) as Deducible10'),
            db::raw('sum(VT_Seguros.PrimaNeta) as PrimaNet')
        )
            ->join('MA_Sucursales','MA_Sucursales.ID','=','VT_Seguros.Sucursal')
            ->join('MA_Gerencias','MA_Gerencias.ID','=','MA_Sucursales.GerenciaID')
            ->where(($this->searchUnidadNegocio)?'MA_Gerencias.UnidadNegocioID':null,'=',$this->searchUnidadNegocio)
            ->where(($this->searchGerencia)?'MA_Sucursales.GerenciaID':null,'=',$this->searchGerencia)
            ->where(($this->searchSucursal)?'MA_Sucursales.ID':null,'=',$this->searchSucursal)
            ->where(($this->searchVendedores)?'VT_Seguros.Ejecutivo':null,'=',$this->searchVendedores);
        if($this->inputFechaInicio && $this->inputFechaFin)
            $seguros = $seguros->whereBetween('VT_Seguros.FechaEmision',[$this->inputFechaInicio,$this->inputFechaFin]);
        $seguros = $seguros->get()->toArray();

        dd($varActaEntregaCargada,$varActaEntregaPendiente,$cotizacionesL2,$cotizacionesCanal,$seguros);*/

    }
}
