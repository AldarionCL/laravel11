<?php

namespace App\Http\Livewire\Reception\Buscadores;

use Livewire\Component;

class IndicadoresAgenda extends Component
{

    public $agendados;
    public $atendidos;
    public $enSucursal;

    public $listeners = ['actualizaIndicadores'];

    public function render()
    {
        return view('livewire.reception.buscadores.indicadores-agenda');
    }

    public function actualizaIndicadores($agendados,$atendidos,$enSucursal): void
    {
        $this->agendados = $agendados;
        $this->atendidos = $atendidos;
        $this->enSucursal = $enSucursal;

        $this->emit('refreshComponent');
    }
}
