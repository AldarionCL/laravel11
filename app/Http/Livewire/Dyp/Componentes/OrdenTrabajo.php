<?php

namespace App\Http\Livewire\Dyp\Componentes;

use App\Models\Clientes;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypOrden;
use App\Models\dyp\DypTareas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class OrdenTrabajo extends Component
{

    public $idDyp;
    public $dyp;
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
    public $inputValorMecanica;
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

    protected $listeners = ['recargaOrden' => '$refresh'];
    public function render()
    {
        $this->dyp = DypFlujos::find($this->idDyp);
        $this->detalleOrden = DypOrden::where('DypID',$this->idDyp)->get();
        $this->dyp = DypFlujos::find($this->idDyp);
        $dyp = $this->dyp;
        $oc = DypTareas::where('DypID',$this->idDyp)->where('DypTipoID',7)->first();



        return view('livewire.dyp.componentes.orden-trabajo');
    }

    public function mount()
    {
        $this->dyp = DypFlujos::find($this->idDyp);
        $this->detalleOrden = DypOrden::where('DypID',$this->idDyp)->get();
        $this->dyp = DypFlujos::find($this->idDyp);
        $dyp = $this->dyp;
        $oc = DypTareas::where('DypID',$this->idDyp)->where('DypTipoID',7)->first();

        $this->inputValorMecanica = 0;
        $this->inputValorDesabollador = 0;
        $this->inputHrsDesabolladura = 0;
        $this->inputValorPlastico = 0;
        $this->inputValorPreparado = 0;
        $this->inputValorPintura = 0;
        $this->inputValorPulido = 0;

        if($oc)
        {
            $this->inputFechaAutorizacion = date('Y-m-d H:i', strtotime($oc->created_at));
            $this->inputDeducible = 0;
            // obtiene el campo deducible
            foreach($oc->Datos as $dato)
            {
                if($dato->Campos->InputName == 'ValorDeducibles')
                {
                    $this->inputDeducible = $dato->Valor;
                }
            }

        }


        // busca el evaluador
        $primerEvaluador =  DypTareas::where('DypID',$dyp->ID)->where('DypTipoID',5)->first();
        if($primerEvaluador)
            $this->evaluador = User::whereIn('ID',[$primerEvaluador->ResponsableID,$primerEvaluador->ResolutorID])->first();

        $this->inputOrdenTrabajo = $dyp->Ot_principal;
        $this->inputSucursal = @$dyp->Sucursal->Sucursal;
        $this->inputFechaIngreso = date('Y-m-d H:i',strtotime($dyp->created_at));
        $this->inputCiaSeguro = $dyp->CompaniaSeguro;
        $this->inputSiniestro = $dyp->NumeroSiniestro;
        $this->inputNombreCliente = $dyp->ClienteNombre . " ". $dyp->ClienteApellido ;
        $this->inputTelefonos = $dyp->ClienteTelefono . " ". $dyp->ClienteTelefono2 ." ". $dyp->ClienteTelefono3;
        $this->inputRecepcion = $dyp->Asesor->Nombre;
        $this->inputMarca = $dyp->Marca;
        $this->inputModelo = $dyp->Modelo;
        $this->inputColor = $dyp->Color;


        $this->trabajos  = trabajosDYP($this->idDyp);
        $this->trabajosAdicionales = DypTareas::where('DypID',$this->idDyp)->where('DypTipoID',20)->where('Estado','Resuelto')->get();
        $this->tareaOrdenCIA = DypTareas::where('DypID',$this->idDyp)->where('DypTipoID',7)->where('Estado','Resuelto')->first();

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


        $this->inputValorMecanica = (isset($this->valores["Total"]["Horas mecánica"]))?$this->valores["Total"]["Horas mecánica"]:0;
        $this->inputValorDesabollador = (isset($this->valores["Total"]["Valor Mano de obra"]))?$this->valores["Total"]["Valor Mano de obra"]:0;
        $this->inputHrsDesabolladura = (isset($this->valores["Total"]["Horas desabolladura"]))?$this->valores["Total"]["Horas desabolladura"]:0;
        $this->inputValorPlastico = (isset($this->valores["Total"]["Horas plastico"]))?$this->valores["Total"]["Horas plastico"]:0;
        $this->inputValorPreparado = (isset($this->valores["Total"]["Piezas preparado"]))?$this->valores["Total"]["Piezas preparado"]:0;
        $this->inputValorPintura = (isset($this->valores["Total"]["Piezas pintor"]))?$this->valores["Total"]["Piezas pintor"]:0;
        $this->inputValorPulido = (isset($this->valores["Total"]["Piezas pulido"]))?$this->valores["Total"]["Piezas pulido"]:0;

        $this->inputDanioNew='';
        $this->inputDescripcionNew='';
        $this->inputDesMontarNew='';
        $this->inputMecanicaNew='';
        $this->inputValorPinturaNew='';
        $this->inputValorRepuestoNew='';

    }

    public function agregarDetalleOrden()
    {
        // se agrega el dato de la tabla DYP_Orden
        $detalleOrden = new DypOrden();
        $detalleOrden->DypID = $this->idDyp;
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
        // se elimina dato de la tabla DYP_Orden
        $detalleOrden = DypOrden::find($idDetalleOrden);
        $detalleOrden->forceDelete();

        $this->inputDanioNew='';
        $this->inputDescripcionNew='';
        $this->inputDesMontarNew='';
        $this->inputMecanicaNew='';
        $this->inputValorPinturaNew='';
        $this->inputValorRepuestoNew='';

        return view('livewire.dyp.componentes.orden-trabajo');

    }
}
