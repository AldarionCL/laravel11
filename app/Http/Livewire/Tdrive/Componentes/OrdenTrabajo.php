<?php

namespace App\Http\Livewire\Tdrive\Componentes;

use App\Models\Clientes;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveOrden;
use App\Models\Tdrive\TdriveTareas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class OrdenTrabajo extends Component
{

    public $idTdrive;
    public $tdrive;
    public $detalleOrden;

    public array $valores;
    public $evaluador;

    public $inputOrdenTrabajo;
    public $inputSucursal;
    public $inputFechaIngreso;
    public $inputFechaAutorizacion;
    public $inputCiaSeguro;
    public $inputLiquidador;
    public $inputSiniestro;
    public $inputDeducible;
    public $inputNombreCliente;
    public $inputTelefonos;
    public $inputRecepcion;
    public $inputMarca;
    public $inputModelo;
    public $inputColor;
    public $inputValorDesabollador;
    public $inputHrsDesabolladura;
    public $inputValorPlastico;
    public $inputValorPreparado;
    public $inputValorPintura;
    public $inputValorPulido;

    // input de detalle de orden
    public $inputDanioNew;
    public $inputDescripcionNew;
    public $inputDesMontarNew;
    public $inputMecanicaNew;
    public $inputValorPinturaNew;
    public $inputValorRepuestoNew;

    public function render()
    {
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $this->detalleOrden = TdriveOrden::where('TdriveID',$this->idTdrive)->get();
        $this->tdrive = TdriveFlujos::find($this->idTdrive);
        $tdrive = $this->tdrive;

        // busca el evaluador
        $primerEvaluador =  TdriveTareas::where('TdriveID',$tdrive->ID)->where('TdriveTipoID',5)->first();
        if($primerEvaluador)
        $this->evaluador = User::whereIn('ID',[$primerEvaluador->ResponsableID,$primerEvaluador->ResolutorID])->first();

        $this->inputOrdenTrabajo = $tdrive->Ot_principal;
        $this->inputSucursal = @$tdrive->Sucursal->Sucursal;
        $this->inputFechaIngreso = date('Y-m-d H:i',strtotime($tdrive->created_at));
        $this->inputFechaAutorizacion = 0;
        $this->inputCiaSeguro = $tdrive->CompaniaSeguro;
        $this->inputLiquidador = '';
        $this->inputSiniestro = $tdrive->NumeroSiniestro;
        $this->inputDeducible = 0;
        $this->inputNombreCliente = $tdrive->ClienteNombre . " ". $tdrive->ClienteApellido ;
        $this->inputTelefonos = $tdrive->ClienteTelefono . " ". $tdrive->ClienteTelefono2 ." ". $tdrive->ClienteTelefono3;
        $this->inputRecepcion = $tdrive->Asesor->Nombre;
        $this->inputMarca = $tdrive->Marca;
        $this->inputModelo = $tdrive->Modelo;
        $this->inputColor = $tdrive->Color;


        $this->trabajos  = trabajosTDRIVE($this->idTdrive);
        $this->trabajosAdicionales = TdriveTareas::where('TdriveID',$this->idTdrive)->where('TdriveTipoID',20)->where('Estado','Resuelto')->get();
        $this->tareaOrdenCIA = TdriveTareas::where('TdriveID',$this->idTdrive)->where('TdriveTipoID',7)->where('Estado','Resuelto')->first();

        if($this->tareaOrdenCIA)
        {
            // estimado inicial
            foreach($this->tareaOrdenCIA->Datos as $tareaOrdenCIA)
            {
                if( $tareaOrdenCIA->Campos->Campo== 'PDF orden')
                    continue;
                $this->valores["Estimado Inicial"][$tareaOrdenCIA->Campos->Campo] = $tareaOrdenCIA->Valor;
            }
            // valores adicionales
            foreach($this->trabajosAdicionales as $trabajosAdicionales) {
                foreach ($trabajosAdicionales->Datos as $trabajosAdicional) {
                    $this->valores["Adicional Orden: " . $trabajosAdicionales->ID][$trabajosAdicional->Campos->Campo] = $trabajosAdicional->Valor;
                }
            }
            // total
            foreach($this->valores as $llave => $valor)
            {
                foreach ($valor as $key => $val)
                {
                    $this->valores["Total"][$key] = (isset($this->valores["Total"][$key])) ? $this->valores["Total"][$key] + $val : $val;
                }
            }
        }


        $this->inputValorDesabollador = (isset($this->valores["Total"]["Valor Mano de obra"]))?$this->valores["Total"]["Valor Mano de obra"]:0;
        $this->inputHrsDesabolladura = (isset($this->valores["Total"]["Horas desabolladura"]))?$this->valores["Total"]["Horas desabolladura"]:0;
        $this->inputValorPlastico = (isset($this->valores["Total"]["Horas plastico"]))?$this->valores["Total"]["Horas plastico"]:0;
        $this->inputValorPreparado = (isset($this->valores["Total"]["Piezas preparado"]))?$this->valores["Total"]["Piezas preparado"]:0;
        $this->inputValorPintura = (isset($this->valores["Total"]["Piezas pintor"]))?$this->valores["Total"]["Piezas pintor"]:0;
        $this->inputValorPulido = (isset($this->valores["Total"]["Piezas pulido"]))?$this->valores["Total"]["Piezas pulido"]:0;

        return view('livewire.tdrive.componentes.orden-trabajo');
    }

    public function mount()
    {

    }

    public function agregarDetalleOrden()
    {
        // se agrega el dato de la tabla TDRIVE_Orden
        $detalleOrden = new TdriveOrden();
        $detalleOrden->TdriveID = $this->idTdrive;
        $detalleOrden->UsuarioID = Auth::user()->ID;
        $detalleOrden->Danio = $this->inputDanioNew;
        $detalleOrden->Descripcion = $this->inputDescripcionNew;
        $detalleOrden->DesMontar = $this->inputDesMontarNew;
        $detalleOrden->Mecanica = $this->inputMecanicaNew;
        $detalleOrden->Pintura = $this->inputValorPinturaNew;
        $detalleOrden->Repuestos = $this->inputValorRepuestoNew;
        $detalleOrden->save();

        $this->inputDanioNew='';
        $this->inputDescripcionNew='';
        $this->inputDesMontarNew='';
        $this->inputMecanicaNew='';
        $this->inputValorPinturaNew='';
        $this->inputValorRepuestoNew='';

    }

    public function eliminarDetalleOrden($idDetalleOrden)
    {
        // se elimina dato de la tabla TDRIVE_Orden
        $detalleOrden = TdriveOrden::find($idDetalleOrden);
        $detalleOrden->forceDelete();

    }
}
