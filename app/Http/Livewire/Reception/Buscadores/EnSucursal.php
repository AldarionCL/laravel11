<?php

namespace App\Http\Livewire\Reception\Buscadores;

use App\Models\reception\Visitas;
use Livewire\Component;

class EnSucursal extends Component
{
    public $idCliente;
    public $rutCliente;
    public $msj;
    public $claseMsj;
    public $fecha;

    public function render()
    {
        $this->msj = '';
        $this->claseMsj = '';

        if($this->idCliente != '') {
            $visita = Visitas::where('FechaCreacion', '>=', date('Y-m-d 00:00:01',strtotime($this->fecha)))
                ->where('FechaCreacion', '<=', date('Y-m-d 23:59:59',strtotime($this->fecha)))
                ->where('ClienteID', $this->idCliente)
                ->orderBy('created_at', 'Desc')->first();
        }
     /*   if($this->rutCliente != null) {
            $visita = Visitas::where('FechaCreacion', '>=', date('Y-m-d 00:00:01'))
                ->where('Rut', str_replace('k', 'K', str_replace('-', '', str_replace('.', '', $this->rutCliente))))
                ->orderBy('created_at', 'Desc')->first();
        }*/

        if(isset($visita))
            if($visita->Fecha_salida == null) {
                $this->msj = 'Cliente se encuentra en sucursal ' . $visita->Sucursales->Sucursal;
                $this->claseMsj = 'fa-hourglass-start text-warning';
            }
            else
            {
                $this->msj = 'Cliente se ha retirado de sucursal '. $visita->Sucursales->Sucursal . ' ('.$visita->Fecha_salida.')';
                $this->claseMsj = 'fa-sign-out text-danger';
            }

        return view('livewire.reception.buscadores.en-sucursal');
    }

    public function mount()
    {
    }
}
