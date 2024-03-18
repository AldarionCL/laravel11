<?php

namespace App\Http\Controllers\Tdrive;

use App\Models\Clientes;
use App\Models\dyp\ColorMarca;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTareas;
use App\Models\Tdrive\TdriveTrabajos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use Dompdf\Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TdriveController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('tdrive.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarCliente(Request $request, $idCliente='')
    {
        $idTdrive = $request->idTDRIVE;
        if($idCliente!='')
        {
            $cliente = Clientes::find($idCliente);
            $cliente->Nombre = $request->nombreInput;
            $cliente->Apellido = $request->apellidoInput;
            $cliente->Rut = $request->rutInput;
            $cliente->Telefono = $request->telefonoInput;
            $cliente->Email = $request->emailInput;
            $cliente->Direccion = $request->direccionInput;
        }

        $tdrive = TdriveFlujos::find($idTdrive);
        $tdrive->SucursalID = $request->inputSucursal;
        $tdrive->ClienteNombre = $request->nombreInput;
        $tdrive->ClienteApellido = $request->apellidoInput;
        $tdrive->ClienteRut = $request->rutInput;
        $tdrive->ClienteTelefono = $request->telefonoInput;
        $tdrive->ClienteEmail = $request->emailInput;
        $tdrive->ClienteDireccion = $request->direccionInput;
        $tdrive->save();

        logTdrive('INFO','Datos de cliente actualizados',$idTdrive);

        return redirect(route('flujotdrive',[$idTdrive]));

    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarVehiculo(Request $request, $idVehiculo = '')
    {
        $idTdrive = $request->idTDRIVE;
        $tdrive = TdriveFlujos::find($request->idTDRIVE);

        $tdrive->Marca = $request->marcaInput;
        $tdrive->Modelo = $request->modeloInput;
        $tdrive->Color = $request->colorInput;
        $tdrive->Patente = $request->patenteInput;
        $tdrive->Vin = $request->vinInput;
        $tdrive->save();
        logTdrive('INFO','Datos de vehículo actualizados',$idTdrive);

        return redirect(route('flujotdrive',[$idTdrive]));

    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarSiniestro(Request $request)
    {
        $idTdrive = $request->idTDRIVE;

        $update= TdriveFlujos::find($idTdrive);
        $update->Magnitud = $request->inputMagnitud;
        $update->CompaniaSeguro = $request->inputCiaSeguro;
        $update->TipoCliente = $request->inputTipoCliente;
        $update->Ot_principal = $request->Ot_principal;
        $update->NumeroSiniestro = $request->NumeroSiniestro;
        $update->save();

        logTdrive('INFO','Datos de siniestro actualizados',$idTdrive);

        return redirect(route('flujotdrive',[$idTdrive]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarArchivos(Request $request)
    {
        $formulario = $request->all();
        $idTdrive = $request->idTdrive;
        $idTarea = $request->inputTarea;
        $tarea = TdriveTareas::find($idTarea);

        // guarda los archivos
        foreach($formulario as $key => $valor) {
            if ($request->hasFile($key)) {
                $archivo = subirArchivoTdrive($request->file($key), $idTarea, $key);
            }
        }

        logTdrive('INFO','Archivos subidos',$idTdrive);

        return redirect(route('flujotdrive',[$idTdrive]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function creaTareaTDRIVE(Request $request, $idTdrive)
    {
        try {
            $nuevaTarea = creaTareaTDRIVE($idTdrive,$request->idTarea,'Abierto');
            logTdrive('INFO','Tarea creada',$idTdrive,$nuevaTarea->ID);

        }catch (Exception $e)
        {
            dd($e);
        }


        return redirect(route('flujotdrive',[$idTdrive]));
    }

    public function creaLogTDRIVE(Request $request, $idTdrive)
    {
        try {
            if($request->has('textolog'))
            {
                logTdrive('COMENTARIO',$request->textolog,$idTdrive);
            }

        }catch (Exception $e)
        {
            dd($e);
        }

        return redirect(route('flujotdrive',[$idTdrive]));
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Crea un nuevo flujo de TDRIVE
        try {
            // Comprueba que el TDRIVE no esté duplicado
            if($request->inputNumeroSiniestro)
            {
                $tdrive = TdriveFlujos::where('NumeroSiniestro',$request->inputNumeroSiniestro)->where('EstadoTdrive','Abierto')->first();

                if ($tdrive)
                {
                    $mensaje = 'Flujo TDRIVE ya existe con el numero de siniestro '.$request->inputNumeroSiniestro;
                    return view('tdrive.nuevoTdrive',compact('mensaje'));
                }
            }

            // crea el flujo tdrive
            $tdrive = new TdriveFlujos();

            if($request->idCliente) {
                $cliente = Clientes::find($request->idCliente);
                $tdrive->ClienteID = $cliente->ID;
            }
            else {
                $cliente = new Clientes();
                $cliente->FechaCreacion = date('Y-m-d H:i:s');
                $cliente->UsuarioCreacionID = Auth::user()->ID;
                $cliente->EventoCreacionID = 1;
                $cliente->TipoClienteID = 1;
                $cliente->InteresesID = 1;
            }

            // Si hay rut de cliente, guarda y asigna al flujo
            if($request->has('inputRutCliente'))
            {
                $cliente->Rut = trim(str_replace('-','', str_replace('.','',$request->inputRutCliente)));
                $cliente->Nombre = $request->inputNombreCliente;
                $cliente->Apellido = $request->inputApellidoCliente;
                $cliente->Email = $request->inputEmailCliente;
                $cliente->Telefono = $request->inputTelefonoCliente;
                if($request->has('inputTelefono2Cliente')) {
                    $cliente->Telefono2 = $request->inputTelefono2Cliente;
                }
                if($request->has('inputTelefono3Cliente')) {
                    $cliente->Telefono3 = $request->inputTelefono3Cliente;
                }
                //Guarda el cliente en la tabla MA_Clientes
                if($cliente->save())
                {
                    //asigna el ID del cliente al flujo
                    $tdrive->ClienteID = $cliente->ID;
                }
            }

            // si no hay rut de cliente,  igual se guarda los datos en el flujo sin asignar el cliente aún
            $tdrive->ClienteNombre = $request->inputNombreCliente;
            $tdrive->ClienteApellido = $request->inputApellidoCliente;
            $tdrive->ClienteEmail = $request->inputEmailCliente;
            $tdrive->ClienteTelefono = $request->inputTelefonoCliente;
            $tdrive->ClienteTelefono2 = $request->inputTelefono2Cliente;
            $tdrive->ClienteTelefono3 = $request->inputTelefono3Cliente;


            // si está listo el cliente , se continúa con el vehículo
            $modelo = Modelos::find($request->inputModelo);
            if($request->idVehiculo) {
                $vehiculo = Vehiculos::find($request->idVehiculo);
            }
            elseif($request->inputPatente)
            {
                $vehiculo = new Vehiculos();
                $vehiculo->FechaCreacion = date('Y-m-d H:i:s');
                $vehiculo->UsuarioCreacionID = Auth::user()->ID;
                $vehiculo->MarcaID = $request->inputMarca;
                $vehiculo->ModeloID = $request->inputModelo;
                $vehiculo->ModeloTxt = $modelo->Modelo;
                $vehiculo->VersionID = ($request->inputVersion) ? $request->inputVersion : 1;
                $vehiculo->ColorID = 47;
                $vehiculo->Vin = $request->inputVin;
                $vehiculo->Patente = str_replace('.','',str_replace('-','',$request->inputPatente));
                $vehiculo->updated_at = date('Y-m-d H:i:s');
                $vehiculo->EventoCreacionID = 1;
                $vehiculo->save();

            }

            // revisa si el vehiculo lo encuentra por Patente o por Vin
            $vehiculofind = Vehiculos::where('Patente',str_replace('.','',str_replace('-','',$request->inputPatente)))->orWhere('Vin',$request->InputVin)->first();

            if($vehiculofind)
            {
                $tdrive->VehiculoId = $vehiculofind->ID;
            }


            $marca = Marca::find($request->inputMarca);
            $modelo = Modelos::find($request->inputModelo);
            $color = $request->inputColor;

            // si está listo el vehículo se procede con el siniestro
            $tdrive->Ot_principal = $request->inputNumeroOT;
            $tdrive->NumeroSiniestro = $request->inputNumeroSiniestro;
            $tdrive->EstadoTdrive = "Abierto";
            $tdrive->Magnitud = $request->inputMagnitud;
            $tdrive->CompaniaSeguro = $request->inputCiaSeguro;
            $tdrive->NumeroPoliza = $request->inputNumPoliza;
            $tdrive->FechaEmisionPoliza = $request->inputFechaEmision;
            //$tdrive->PrimaNeta = $request->inputPrimaNeta;
            $tdrive->TipoCliente = $request->inputTipoCliente;
            $tdrive->SucursalID = $request->inputSucursal;
            $tdrive->AsesorID = Auth::user()->ID;
            $tdrive->Patente = str_replace('.','',str_replace('-','',$request->inputPatente));
            $tdrive->Vin = $request->inputVin;
            $tdrive->Marca = $marca->Marca;
            $tdrive->Modelo = $modelo->Modelo;
            $tdrive->Color = $color;
            $tdrive->Cono = null;

            if($tdrive->save())
            {
                $mensaje = 'Flujo TDRIVE ('.$tdrive->ID.') Creado exitosamente ';
                logTdrive('INFO','Nuevo TDRIVE creado exitosamente',$tdrive->ID);
                return view('tdrive.nuevoTdrive',compact('mensaje'));
            }


            $mensaje = 'Flujo TDRIVE no ha sido creado exitosamente ';
            return view('tdrive.nuevoTdrive',compact('mensaje'));

        }catch (Exception $e)
        {
            $mensaje = 'Flujo TDRIVE no ha sido creado exitosamente : error ('.$e->getMessage().')';
            return view('tdrive.nuevoTdrive',compact('mensaje'));
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_tiempos()
    {

        return view('tdrive.reportes.reporteTiempos');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('tdrive.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function pruebaresponsable(Request $request, $id)
    {
        $responsable = asignaResponsable($id);
        dd($responsable);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function leerQr()
    {

        return view('tdrive.leerQr');
    }

    public function compruebaQR(Request $request)
    {
        try {
            // Comprueba si es trabajador TDRIVE
            $trabajoTdrive = esTrabajadorTdrive(Auth::user()->ID);
            if(!$trabajoTdrive)
            {
                $salida = [
                    'titulo' => 'No puede realizar trabajos en el vehículo' ,
                    'texto' => 'Ud. No tiene permisos para realizar esta acción.',
                    'icono' => 'warning',
                    'cancelbutton' => false
                ];

                return $salida;
            }



            $valorQR = $request->valor;
            $vehiculo = Vehiculos::where('Vin',$valorQR)->first();
            $tdrive = TdriveFlujos::where('VehiculoID',$vehiculo->ID)->where('EstadoTdrive','Abierto')->first();

            if($tdrive)
            {
                $taller = TdriveTareas::where('TdriveID',$tdrive->ID)->where('Estado','Abierto')->where('TdriveTipoID',13)->first();
                if($taller)
                {

                    // si es torre de control,  podrá finalizar el taller para revisar la calidad
                    if($trabajoTdrive == 'TORRE DE CONTROL')
                    {
                        if($request->tipo == 'Comprobar')
                        {
                            $salida = [
                                'titulo' => 'Quiere revisar los trabajos en taller y controlar la Calidad ?' ,
                                'texto' => 'Se le redirigirá al detalle del taller para que pueda revisar los trabajos realizados. Una vez comprobado los datos podrá pasar a cotrol de calidad desde dicha página.',
                                'icono'=> 'question',
                                'cancelbutton' => true

                            ];
                            return $salida;

                        }else
                        {
                            $salida = [
                                'titulo' => route('tallertdrive',[$taller->ID]),
                                'texto' => '',
                                'icono'=> 'redirect',
                                'cancelbutton' => true

                            ];
                            return $salida;
                        }
                    }


                    //comprueba el tipo de trabajo con el mismo usuario
                    $trabajo = TdriveTrabajos::where('TareaID',$taller->ID)
                        ->where('TipoTrabajo',$trabajoTdrive)->where('Estado',"Comenzado")->first();
                    if($trabajo)
                    {
                        if($trabajo->Estado == 'Comenzado')
                        {
                            if($request->tipo == 'Comprobar')
                            {
                                $salida = [
                                    'titulo' => 'Finalizar el trabajo actual?' ,
                                    'texto' => 'Trabajo de '.$trabajoTdrive. ' Iniciado, si prosigue se Finalizará el trabajo actual y pasará al siguiente. Si falta por realizar cancele.',
                                    'icono'=> 'question',
                                    'cancelbutton' => true

                                ];
                            }else
                            {
                                // actualiza para finalizar el trabajo
                                $trabajo->ResolutorID = Auth::user()->ID;
                                $trabajo->FechaTermino = date('Y-m-d H:i:s');
                                $trabajo->Estado = 'Terminado';
                                logTdrive('INFO','Trabajo finalizado',$tdrive->ID,$taller->ID);
                            }

                        }else
                        {
                            if($request->tipo == 'Comprobar')
                            {
                                $salida = [
                                    'titulo' => 'Quiere iniciar el trabajo de ('.$trabajoTdrive.') ?' ,
                                    'texto' => 'El trabajo de '.$trabajoTdrive. ' se iniciará , y comenzará a contabilizar el tiempo abierto, si no quiere iniciar todavía, cancele. ',
                                    'icono'=> 'question',
                                    'cancelbutton' => true

                                ];
                            }else
                            {
                                // crea un nuevo trabajo
                                $trabajo = new TdriveTrabajos();
                                $trabajo->Estado = 'Comenzado';
                                $trabajo->InicianteID = Auth::user()->ID;
                                $trabajo->FechaInicio = date('Y-m-d H:i:s');
                                logTdrive('INFO','Trabajo iniciado',$tdrive->ID,$taller->ID);
                            }
                        }
                    }else
                    {
                        if($request->tipo == 'Comprobar')
                        {
                            $salida = [
                                'titulo' => 'Quiere iniciar el trabajo de ('.$trabajoTdrive.') ?' ,
                                'texto' => 'El trabajo de '.$trabajoTdrive. ' se iniciará , y comenzará a contabilizar el tiempo abierto, si no quiere iniciar todavía, cancele. ',
                                'icono'=> 'question',
                                'cancelbutton' => true

                            ];
                        }else
                        {
                            // crea un nuevo trabajo
                            $trabajo = new TdriveTrabajos();
                            $trabajo->Estado = 'Comenzado';
                            $trabajo->InicianteID = Auth::user()->ID;
                            $trabajo->FechaInicio = date('Y-m-d H:i:s');
                            logTdrive('INFO','Trabajo iniciado',$tdrive->ID,$taller->ID);
                        }
                    }

                    if($request->tipo != 'Comprobar')
                    {
                        $trabajo->TdriveID = $taller->TdriveID;
                        $trabajo->TareaID = $taller->ID;
                        $trabajo->TipoTrabajo = $trabajoTdrive;

                        if($trabajo->save())
                        {
                            // Elimina al vehículo del patio
                            $actualizapatio = TdriveFlujos::find($tdrive->ID);
                            $actualizapatio->Cono = '';
                            $actualizapatio->save();

                            // Finaliza los trabajos y pasa a Control Calidad Si finaliza el Lavado
                            if($trabajoTdrive == 'LAVADOR' && $trabajo->Estado == 'Terminado')
                            {
                                $FlujoController =  new FlujoController();
                                // enviar a la funcion de completar tarea los datos para pasar a Control de calidad.
                            }

                            $salida = [
                                'titulo' => 'Trabajo actualizado con éxito' ,
                                'texto' => 'Se ha '.$trabajo->Estado. ' el trabajo de tipo ('.$trabajoTdrive.')',
                                'icono' => 'success',
                                'cancelbutton' => false

                            ];
                        }
                    }
                }
                else
                {
                    $salida = [
                        'titulo' => 'El vehículo no está en proceso de taller aún.' ,
                        'texto' => 'No hay Taller abierto para registrar los trabajos en este vehículo',
                        'icono' => 'warning',
                        'cancelbutton' => false

                    ];
                }

            }else
            {
                $salida = [
                    'titulo' => 'Ocurrió un error con los datos del vehículo' ,
                    'texto' => 'No se encontró datos del vehículo en Tdrive',
                    'icono' => 'error',
                    'cancelbutton' => false

                ];
            }

        }catch (Exception $e)
        {
            $salida = [
                'titulo' => 'Ocurrió un error interno' ,
                'texto' => $e->getMessage(),
                'icono' => 'error',
                'cancelbutton' => false

            ];
        }

        return $salida;
    }
}


