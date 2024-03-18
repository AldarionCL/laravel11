<?php

namespace App\Http\Livewire\Cpd\Componentes;

use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdInspeccion;
use App\Models\Cpd\CpdInspeccionDetalle;
use App\Models\Cpd\CpdTareas;
use App\Models\dyp\DypFlujos;
use Livewire\Component;

class FormularioInspeccion extends Component
{

    public $idCpd;
    public $idTarea;
    public $tareas;
    public $cpd;
    public $inspeccion;

    public array $detalle;
    public array $input;

    public array $options = [
        ['dato' => 'Si'],
        ['dato' => 'No'],
    ];
    public array $options2 = [
        ['dato' => 'Bueno'],
        ['dato' => 'Malo'],
        ['dato' => 'No tiene'],
    ];

    public function render()
    {

        $this->tareas = CpdTareas::where('CpdID',$this->idTarea)->get();
        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->inspeccion = CpdInspeccion::where('idCpd',$this->idCpd)->first();


        return view('livewire.cpd.componentes.formulario-inspeccion');
    }

    public function mount()
    {

        $this->cpd = CpdFlujos::find($this->idCpd);
        $this->inspeccion = CpdInspeccion::where('idCpd',$this->idCpd)->first();

        $this->input["Patente"] = $this->cpd->Patente;
        $this->input["Marca"] = $this->cpd->Marca;
        $this->input["Modelo"] = $this->cpd->Modelo;
        $this->input["Version"] = $this->cpd->Version;
        $this->input["Kilometraje"] = $this->cpd->Kilometraje;
        $this->input["Vin"] = $this->cpd->Vin;
        $this->input["Motor"] = $this->cpd->Vin;
        $this->input["Color"] = $this->cpd->Color;
        $this->input["Anio"] = $this->cpd->Anio;

        $this->detalle = ["nuevo"=>[
            'tipo'=>'',
            'costo'=>'',
            'comentario'=>'',
            'ubicacion'=>''
        ]];


        if($this->inspeccion)
        {
            // LLena los datos del formulario
            foreach ($this->inspeccion->getAttributes() as $key => $value) {
                $this->input[$key] = $value;
            }
        }

    }

    public function save()
    {
        // guarda todos los datos del array input en la tabla CPD_Inspeccion

        $formulario = CpdInspeccion::where('idCpd',$this->idCpd)->first();
        if($formulario)
        {
            $datos = CpdInspeccion::find($formulario->ID);
        }
        else
        {
            $datos = new CpdInspeccion();
        }

        $datos->idCpd = $this->idCpd;
        $datos->idTarea = $this->idTarea;

        foreach($this->input as $key => $value)
        {
            $datos->$key = $value;
        }

        $datos->save();

    }
}
