<?php

namespace App\Http\Livewire\Cpd\Componentes\Create;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdInspeccion;
use App\Models\Cpd\CpdInspeccionDetalle;
use App\Models\Cpd\CpdTareas;
use Livewire\Component;

class DetalleInspeccion extends Component
{

    public $idCpd;
    public $idTarea;
    public $tareas;
    public $cpd;
    public $inspeccion;

    public array $detalle;
    public function render()
    {
        $this->tareas = CpdTareas::where('CpdID',$this->idTarea)->get();
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->inspeccion = CpdInspeccion::where('idCpd',$this->idCpd)->first();

        if(isset($this->inspeccion->Detalles)) {
            foreach ($this->inspeccion->Detalles as $key => $detalle) {
                $this->detalle[$key] = [
                    'ID' => $detalle->ID,
                    'TipoDanio' => $detalle->TipoDanio,
                    'Costo' => $detalle->Costo,
                    'Comentario' => $detalle->Comentario,
                    'Ubicacion' => $detalle->Ubicacion
                ];

            }
        }
        return view('livewire.cpd.componentes.create.detalle-inspeccion');
    }


    public function mount()
    {
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->inspeccion = CpdInspeccion::where('idCpd',$this->idCpd)->first();

        $this->detalle = ["nuevo"=>[
            'TipoDanio'=>'',
            'Costo'=>'',
            'Comentario'=>'',
            'Ubicacion'=>''
        ]];

        if(isset($this->inspeccion->Detalles)) {
            foreach ($this->inspeccion->Detalles as $key => $detalle) {
                $this->detalle[$key] = [
                    'ID' => $detalle->ID,
                    'TipoDanio' => $detalle->TipoDanio,
                    'Costo' => $detalle->Costo,
                    'Comentario' => $detalle->Comentario,
                    'Ubicacion' => $detalle->Ubicacion
                ];

            }
        }

    }

    public function add()
    {
        $this->inspeccion = CpdInspeccion::where('idCpd',$this->idCpd)->first();

        // crea el detalle nuevo

        $nuevoDetalle = new CpdInspeccionDetalle();
        $nuevoDetalle->idInspeccion = $this->inspeccion->ID;
        $nuevoDetalle->idCpd = $this->idCpd;
        $nuevoDetalle->TipoDanio = $this->detalle["nuevo"]["TipoDanio"];
        $nuevoDetalle->Costo = $this->detalle["nuevo"]["Costo"];
        $nuevoDetalle->Comentario = $this->detalle["nuevo"]["Comentario"];
        $nuevoDetalle->Ubicacion = $this->detalle["nuevo"]["Ubicacion"];
        $nuevoDetalle->save();


        $this->detalle["nuevo"] = [
            'TipoDanio'=>'',
            'Costo'=>'',
            'Comentario'=>'',
            'Ubicacion'=>''
        ];

    }

    public function delete($id)
    {
        $detalle = CpdInspeccionDetalle::find($id);
        $detalle->forcedelete();
    }
}
