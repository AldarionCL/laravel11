<?php

namespace App\Http\Livewire\Cpd\Componentes\Modales;

use App\Models\Cpd\CpdLog;
use App\Models\dyp\ColorMarca;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalLogs extends ModalComponent
{

    public $idCpd;
    public $tareas;
    public $cpdlogs;

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        $this->cpdlogs = CpdLog::where('CpdID',$this->idCpd)->orderBy('created_at','desc')->get();

        return view('livewire.cpd.componentes.modales.modal-logs');
    }

    public function mount()
    {
        $this->cpdlogs = CpdLog::where('CpdID',$this->idCpd)->orderBy('created_at','desc')->get();

    }


}
