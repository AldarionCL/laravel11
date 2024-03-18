<?php

namespace App\Http\Livewire\Cpd\Buscadores;

use App\Models\AgendamientoTipo;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\Gerencias;
use App\Models\Sucursales;
use Livewire\Component;


class CpdGerencia extends Component
{

    public $searchGerencia;
    public $searchSucursal;
    public $searchMarca;
    public $searchModelo;
    public $searchTipoAgenda;
    public $inputFechaInicio;
    public $inputFechaFin;

    public $tipo;

    public array $gerencias;
    public array $marcas;
    public array $modelos;
    public array $sucursales;
    public array $tipoagenda;


    public function render()
    {
        return view('livewire.cpd.buscadores.cpd-gerencia');
    }

    public function updated($value, $data)
    {
        if($this->searchGerencia)
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->whereIn('GerenciaID',$this->searchGerencia)->get()->toArray();
        else{
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->where('Sucursal','like','%Servicio%')->where('Activa',1)->orderBy('Sucursal', 'ASC' )->get()->toArray();
        }
        $this->emit('updateDatatable',$this->searchMarca, $this->searchModelo,$this->inputFechaInicio,$this->inputFechaFin);
    }

    public function mount()
    {
        $this->sucursales = Sucursales::select('ID', 'Sucursal' )->where('Sucursal','like','%Servicio%')->where('Activa',1)->orderBy('Sucursal', 'ASC' )->get()->toArray();
        $this->marcas = Marca::select('ID', 'Marca' )->where('Activo',1)->orderBy('Marca', 'ASC' )->get()->toArray();
        $this->modelos = Modelos::select('ID', 'Modelo' )->where('Activo',1)->orderBy('Modelo', 'ASC' )->get()->toArray();
        $this->tipoagenda = AgendamientoTipo::select('ID', 'Tipo' )->orderBy('ID', 'ASC' )->whereIn('ID',[46,47,49])->get()->toArray();
    }

    public function search()
    {
        $this->emit('updateDatatable',$this->searchMarca, $this->searchModelo,$this->inputFechaInicio,$this->inputFechaFin);

        return view('livewire.cpd.buscadores.cpd-gerencia');
    }
}
