<?php

namespace App\Http\Livewire\Dyp\Componentes\Modales;

use App\Models\dyp\ColorMarca;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypTipos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use Dompdf\Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Request;


class TallerGrid extends Component
{

    public $idDyp;
    public $puesto;
    public $dyp;
    public $tareas;
    public $idTarea;
    public $idSucursal;
    public $vehiculosTaller;

    public $matriz;
    public $filas;
    public $columnas;
    public $letras;
    public $titulos;
    public $puestos;


    public function render()
    {
        $this->filas = 20;
        $this->columnas = 10;

       /* $this->letras = [
            '','A','B','C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        ];

        $this->titulos = [
            '','A','B','C','D','E','F','G','H','I','J','K','L','M','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        ];*/

        $this->titulos = array(
            'patio1'=>[
                ['A','PB','B','C','PD','D','E','F']
            ],
            'patio2'=>[
                ['G','H','I','PJ','J','K','PL','L']
            ],

        );

        $this->puestos = array(
            'patio1' => [
                ['A1','PB1','B1','C1','PD1','D1','E1','F1'],
                ['A2','','B2','C2','','D2','E2','F2'],
                ['A3','PB2','B3','C3','PD2','D3','E3','F3'],
                ['A4','','B4','C4','','D4','E4','F4'],
                ['A5','PB3','B5','C5','PD3','D5','E5','F5'],
                ['A6','','B6','C6','','D6','E6','F6'],
                ['A7','PB4','B7','C7','PD4','D7','E7','F7'],
                ['A8','','B8','C8','','D8','E8','F8'],
                ['A9','PB5','B9','C9','PD5','D9','E9','F9'],
                ['A10','','B10','C10','','D10','E10','F10'],
                ['A11','PB6','B11','C11','PD6','D11','E11','F11'],
                ['A12','','B12','C12','','D12','E12','F12'],
                ['A13','PB7','B13','C13','PD7','D13','E13','F13'],
                ['A14','','B14','C14','','D14','E14','F14'],
                ['A15','PB8','B15','C15','PD8','D15','E15','F15'],
                ['A16','','B16','C16','','D16','E16','F16'],
                ['A17','PB9','B17','C17','PD9','D17','E17','F17'],
                ['A18','','B18','C18','','D18','E18','F18'],
                ['A19','','B19','C19','','D19','E19','F19'],
            ],
            'patio2' => [
                ['','H1','I1','PJ1','J1','K1','PL1','L1'],
                ['','H2','I2','','J2','K2','','L2'],
                ['G1','H3','I3','PJ2','J3','K3','PL2','L3'],
                ['G2','H4','I4','','J4','K4','','L4'],
                ['G3','H5','I5','PJ3','J5','K5','PL3','L5'],
                ['G4','H6','I6','','J6','K6','','L6'],
                ['G5','H7','I7','PJ4','J7','K7','PL4','L7'],
                ['G6','H8','I8','','J8','K8','','L8'],
                ['G7','H9','I9','PJ5','J9','K9','PL5','L9'],
                ['G8','H10','I10','','J10','K10','','L10'],
                ['','H11','I11','PJ6','J11','K11','PL6','L11'],
                ['','H12','I12','','J12','K12','','L12'],
                ['','H13','I13','PJ7','J13','K13','PL7','L13'],
                ['G9','H14','I14','','J14','K14','','L14'],
                ['G10','H15','I15','PJ8','J15','K15','PL8','L15'],
                ['G11','H16','I16','','J16','K16','','L16'],
                ['G12','H17','I17','PJ9','J17','K17','PL9','L17'],
                ['G13','H18','I18','','J18','K18','','L18'],
                ['G14','H19','I19','','J19','K19','','L19'],
                ['','','','','','','','L20'],
                ['','','','','','','','L21'],
                ['','','','','','','','L22'],

            ],
        );

        /*$this->puestos = [ "patio1" => array(
            "A" => "19",
            "PB" => "9",
            "PB" => "9",
            "B" => "19",
            "C" => "19",
            "PD" => "9",
            "D" => "19",
            "E" => "19",
            "F" => "19"

        ),
        "patio2" => array(
            "G" => "19",
            "H" => "19",
            "I" => "19",
            "PJ" => "9",
            "J" => "19",
            "K" => "19",
            "PL" => "9",
            "L" => "22",
        )
        ];*/


        $this->vehiculosTaller = DypFlujos::whereNotNull('Cono');
        $this->vehiculosTaller = $this->vehiculosTaller->get();

        foreach ($this->vehiculosTaller as $vehiculo)
        {
            if($vehiculo->Cono != "") {
                $this->matriz[$vehiculo->Cono]["patente"] = $vehiculo->Patente;
                $this->matriz[$vehiculo->Cono]["dyp"] = $vehiculo->ID;
            }
        }

        return view('livewire.dyp.componentes.modales.taller-grid');
    }


}
