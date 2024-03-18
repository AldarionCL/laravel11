<?php

namespace App\Http\Livewire\Dyp\Buscadores;

use App\Models\AgendamientoTipo;
use App\Models\Gerencias;
use App\Models\Sucursales;
use Livewire\Component;


class DypGerencia extends Component
{

    public $searchGerencia;
    public $searchSucursal;
    public $searchTipoAgenda;
    public $inputFechaInicio;
    public $inputFechaFin;

    public $tipo;

    public array $gerencias;
    public array $sucursales;
    public array $tipoagenda;


    public function render()
    {
        return view('livewire.dyp.buscadores.dyp-gerencia');
    }

    public function updated($value, $data)
    {
        if($this->searchGerencia)
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->whereIn('GerenciaID',$this->searchGerencia)->get()->toArray();
        else{
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->where('Sucursal','like','%Servicio%')->where('Activa',1)->orderBy('Sucursal', 'ASC' )->get()->toArray();
        }
        $this->emit('updateDatatable',$this->searchGerencia, $this->searchSucursal,$this->inputFechaInicio,$this->inputFechaFin);

    }

    public function mount()
    {
        $this->sucursales = Sucursales::select('ID', 'Sucursal' )->where('Sucursal','like','%Servicio%')->where('Activa',1)->orderBy('Sucursal', 'ASC' )->get()->toArray();
        $this->tipoagenda = AgendamientoTipo::select('ID', 'Tipo' )->orderBy('ID', 'ASC' )->whereIn('ID',[46,47,49])->get()->toArray();
    }

    public function search()
    {
        $this->emit('updateDatatable',$this->searchGerencia, $this->searchSucursal,$this->inputFechaInicio,$this->inputFechaFin);

        return view('livewire.dyp.buscadores.dyp-gerencia');
    }
}
