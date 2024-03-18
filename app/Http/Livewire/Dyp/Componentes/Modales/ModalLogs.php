<?php

namespace App\Http\Livewire\Dyp\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\dyp\DypArchivos;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypLog;
use App\Models\dyp\DypTareas;
use App\Models\dyp\DypTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalLogs extends ModalComponent
{

    public $idDyp;
    public $tareas;
    public $dyplogs;

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        $this->dyplogs = DypLog::where('DypID',$this->idDyp)->orderBy('created_at','desc')->get();

        return view('livewire.dyp.componentes.modales.modal-logs');
    }

    public function mount()
    {
        $this->dyplogs = DypLog::where('DypID',$this->idDyp)->orderBy('created_at','desc')->get();

    }


}
