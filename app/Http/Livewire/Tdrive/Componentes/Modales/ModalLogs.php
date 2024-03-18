<?php

namespace App\Http\Livewire\Tdrive\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\Tdrive\TdriveArchivos;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveLog;
use App\Models\Tdrive\TdriveTareas;
use App\Models\Tdrive\TdriveTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use LivewireUI\Modal\ModalComponent;


class ModalLogs extends ModalComponent
{

    public $idTdrive;
    public $tareas;
    public $tdrivelogs;

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        $this->tdrivelogs = TdriveLog::where('TdriveID',$this->idTdrive)->orderBy('created_at','desc')->get();

        return view('livewire.tdrive.componentes.modales.modal-logs');
    }

    public function mount()
    {
        $this->tdrivelogs = TdriveLog::where('TdriveID',$this->idTdrive)->orderBy('created_at','desc')->get();

    }


}
