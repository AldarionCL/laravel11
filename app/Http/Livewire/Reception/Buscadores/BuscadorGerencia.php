<?php

namespace App\Http\Livewire\Reception\Buscadores;

use App\Models\AgendamientoTipo;
use App\Models\Gerencias;
use App\Models\Sucursales;
use Livewire\Component;


class BuscadorGerencia extends Component
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
        return view('livewire.reception.buscadores.buscador-gerencia');
    }

    public function updated($value, $data)
    {
        if($this->searchGerencia)
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->whereIn('GerenciaID',$this->searchGerencia)->get()->toArray();
        else{
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->get()->toArray();
        }
        $this->emit('updateDatatable',$this->searchGerencia, $this->searchSucursal,$this->inputFechaInicio,$this->inputFechaFin);

    }



    public function mount()
    {
        $this->gerencias =  Gerencias::select('ID', 'Gerencia' )->orderBy('Gerencia', 'ASC' )->get()->toArray();
        $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->get()->toArray();
        $this->tipoagenda = AgendamientoTipo::select('ID', 'Tipo' )->orderBy('ID', 'ASC' )->whereIn('ID',[46,47,49])->get()->toArray();

        if($this->searchGerencia)
            $this->sucursales = Sucursales::select('ID', 'Sucursal' )->orderBy('Sucursal', 'ASC' )->whereIn('GerenciaID',$this->searchGerencia)->get()->toArray();


    }


    public function search()
    {
        if($this->tipo == 'agendamiento')
            $this->emit('actualizaAgendamientos',$this->searchGerencia, $this->searchSucursal,$this->inputFechaInicio,$this->inputFechaFin,$this->searchTipoAgenda);
        if($this->tipo == 'lista_asistencia')
            $this->emit('updateDatatable',$this->searchGerencia, $this->searchSucursal,$this->inputFechaInicio,$this->inputFechaFin);

        return view('livewire.reception.componentes.lista-visita');
    }


}
