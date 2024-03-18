<?php

namespace App\Http\Livewire\Reception\Componentes;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaVisita extends Component
{
    public function render()
    {
        $usuario = User::find(Auth::user()->ID);

        return view('livewire.reception.componentes.lista-visita');
    }
}
