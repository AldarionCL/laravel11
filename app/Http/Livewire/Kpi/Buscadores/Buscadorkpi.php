<?php

namespace App\Http\Livewire\Kpi\Buscadores;

use App\Models\AgendamientoTipo;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\Gerencias;
use App\Models\Kpi\Canales;
use App\Models\Kpi\TiposVentas;
use App\Models\Sucursales;
use App\Models\User;
use Livewire\Component;

class Buscadorkpi extends Component
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
    public $inputFechaInicio;
    public $inputFechaFin;

    public $tipo;

    public array $gerencias;
    public array $sucursales;
    public array $vendedores;
    public array $marcas;
    public array $tipoventas;
    public array $modelos;
    public array $canales;
    public array $cierres;
    public array $cupones;
    public array $oficinas;


    public function render()
    {

        if($this->inputFechaInicio == '')
            $this->inputFechaInicio = date('Y-m-01', strtotime(date('Y-m-d')));
        if($this->inputFechaFin == '')
            $this->inputFechaFin = date('Y-m-d');

        return view('livewire.kpi.buscadores.buscadorkpi');
    }

    public function updated($value, $data)
    {
        if($this->searchGerencia)
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->whereIn('GerenciaID',$this->searchGerencia)->get()->toArray();
        else{
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->get()->toArray();
        }
        if($this->searchModelo)
            $this->modelos = Modelos::select('ID', 'Modelo' )->where('MarcaID',$this->searchModelo)->orderBy('Modelo', 'ASC' )->get()->toArray();

        $this->emit('updateDatatable',$this->searchGerencia, $this->searchSucursal,$this->inputFechaInicio,$this->inputFechaFin);

    }

    public function mount()
    {
        $this->gerencias =  Gerencias::select('ID', 'Gerencia' )->orderBy('Gerencia', 'ASC' )->get()->toArray();
        $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->get()->toArray();
        $this->vendedores = User::select('ID', 'Nombre' )->where('PerfilID',3)->where('CargoID',7)->where('Activo',1)->get()->toArray();
        $this->marcas = Marca::select('ID', 'Marca' )->orderBy('Marca', 'ASC' )->get()->toArray();
        $this->tipoventas = TiposVentas::select('ID', 'TipoVenta' )->orderBy('TipoVenta', 'ASC' )->get()->toArray();
        $this->modelos = Modelos::select('ID', 'Modelo' )->orderBy('Modelo', 'ASC' )->get()->toArray();
        $this->canales = Canales::select('ID', 'Canal' )->orderBy('Canal', 'ASC' )->get()->toArray();
        $this->cierres[] = ['ID'=>0,'Cierre'=>'NO'];
        $this->cierres[] = ['ID'=>1,'Cierre'=>'SI'];
        $this->cupones[] = ['ID'=>'Flota','Cupon'=>'FLOTA'];
        $this->cupones[] = ['ID'=>'Flotilla','Cupon'=>'FLOTILLA'];
        $this->cupones[] = ['ID'=>'Retail','Cupon'=>'RETAIL'];
        $this->oficinas[] = ['ID'=>0,'Oficina'=>'SIN OFICINA'];
        $this->oficinas[] = ['ID'=>1,'Oficina'=>'CON OFICINA'];

        if($this->inputFechaInicio == '')
            $this->inputFechaInicio = date('Y-m-01', strtotime(date('Y-m-d')));
        if($this->inputFechaFin == '')
            $this->inputFechaFin = date('Y-m-d');


        if($this->searchGerencia)
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->whereIn('GerenciaID',$this->searchGerencia)->get()->toArray();

        if($this->searchModelo)
            $this->modelos = Modelos::select('ID', 'Modelo' )->whereIn('MarcaID',$this->searchModelo)->orderBy('Modelo', 'ASC' )->get()->toArray();

    }

    public function search()
    {
        $this->emit("updateTablaKpi",
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
            $this->inputFechaInicio,
            $this->inputFechaFin);
    }




}
