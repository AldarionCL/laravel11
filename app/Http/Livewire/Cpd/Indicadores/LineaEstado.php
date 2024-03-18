<?php

namespace App\Http\Livewire\Cpd\Indicadores;

use App\Models\Cpd\CpdTareas;
use Livewire\Component;

class LineaEstado extends Component
{

    public $idCpd;
    public $tareasCPD;

    public array $dias = [
        'Mon' => 'Lunes',
        'Tue' => 'Martes',
        'Wed' => 'Miercoles',
        'Thu' => 'Jueves',
        'Fri' => 'Viernes',
        'Sat' => 'Sabado',
        'Sun' => 'Domingo',
    ];
    public array $meses = [
        'Jan' => 'Enero',
        'Feb' => 'Febrero',
        'Mar' => 'Marzo',
        'Apr' => 'Abril',
        'May' => 'Mayo',
        'Jun' => 'Junio',
        'Jul' => 'Julio',
        'Ago' => 'Agosto',
        'Sep' => 'Septiembre',
        'Oct' => 'Octubre',
        'Nov' => 'Noviembre',
        'Dec' => 'Diciembre',
    ];

    public function render()
    {
        $tareasCPD = CpdTareas::select('ID')->where('CpdID',$this->idCpd)->latest('created_at')
            ->take(3)->pluck('ID')->toArray();
        $this->tareasCPD = CpdTareas::whereIn('ID',$tareasCPD)->orderBy('created_at','ASC')->get();


        return view('livewire.cpd.indicadores.linea-estado');
    }
}
