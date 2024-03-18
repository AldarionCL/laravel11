<?php

namespace App\Http\Controllers\Dyp;

use App\Models\Clientes;
use App\Models\dyp\ColorMarca;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypTareas;
use App\Models\dyp\DypTrabajos;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use Dompdf\Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DypController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('dyp.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarCliente(Request $request, $idCliente='')
    {
        $idDyp = $request->idDYP;
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

        $dyp = DypFlujos::find($idDyp);
        $dyp->SucursalID = $request->inputSucursal;
        $dyp->ClienteNombre = $request->nombreInput;
        $dyp->ClienteApellido = $request->apellidoInput;
        $dyp->ClienteRut = $request->rutInput;
        $dyp->ClienteTelefono = $request->telefonoInput;
        $dyp->ClienteEmail = $request->emailInput;
        $dyp->ClienteDireccion = $request->direccionInput;
        $dyp->save();

        logDyp('INFO','Datos de cliente actualizados',$idDyp);

        if($request->idTarea != '')
        {
            return redirect(route('tareadyp',[$request->idTarea]));
        }

        return redirect(route('flujodyp',[$idDyp]));

    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarVehiculo(Request $request, $idVehiculo = '')
    {
        $idDyp = $request->idDYP;
        $dyp = DypFlujos::find($request->idDYP);

        $dyp->Marca = $request->marcaInput;
        $dyp->Modelo = $request->modeloInput;
        $dyp->Color = $request->colorInput;
        $dyp->Patente = $request->patenteInput;
        $dyp->Vin = $request->vinInput;
        $dyp->save();
        logDyp('INFO','Datos de vehículo actualizados',$idDyp);

        return redirect(route('flujodyp',[$idDyp]));

    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarSiniestro(Request $request)
    {
        $idDyp = $request->idDYP;

        $update= DypFlujos::find($idDyp);
        $update->Magnitud = $request->inputMagnitud;
        $update->CompaniaSeguro = $request->inputCiaSeguro;
        $update->TipoCliente = $request->inputTipoCliente;
        $update->Ot_principal = $request->Ot_principal;
        $update->NumeroSiniestro = $request->NumeroSiniestro;
        $update->save();

        logDyp('INFO','Datos de siniestro actualizados',$idDyp);

        return redirect(route('flujodyp',[$idDyp]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarArchivos(Request $request)
    {
        $formulario = $request->all();
        $idDyp = $request->idDyp;
        $idTarea = $request->inputTarea;
        $tarea = DypTareas::find($idTarea);

        // guarda los archivos
        foreach($formulario as $key => $valor) {
            if ($request->hasFile($key)) {
                $archivo = subirArchivoDyp($request->file($key), $idTarea, $key);
            }
        }

        logDyp('INFO','Archivos subidos',$idDyp);

        return redirect(route('flujodyp',[$idDyp]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function creaTareaDYP(Request $request, $idDyp)
    {
        try {
            $nuevaTarea = creaTareaDYP($idDyp,$request->idTarea,'Abierto');

            if($request->has('motivoTarea'))
            {
                $nuevaTarea->MotivoCreacion = $request->motivoTarea;
                $nuevaTarea->save();
            }
            logDyp('INFO','Tarea creada',$idDyp,$nuevaTarea->ID);

        }catch (Exception $e)
        {
            dd($e);
        }


        return redirect(route('flujodyp',[$idDyp]));
    }

    public function creaLogDYP(Request $request, $idDyp)
    {
        try {
            if($request->has('textolog'))
            {
                logDyp('COMENTARIO',$request->textolog,$idDyp);
            }

        }catch (Exception $e)
        {
            dd($e);
        }

        return redirect(route('flujodyp',[$idDyp]));
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Crea un nuevo flujo de DYP
        try {
            // Comprueba que el DYP no esté duplicado
            if($request->inputNumeroSiniestro)
            {
                $dyp = DypFlujos::where('NumeroSiniestro',$request->inputNumeroSiniestro)->where('EstadoDyp','Abierto')->first();

                if ($dyp)
                {
                    $mensaje = 'Flujo DYP ya existe con el numero de siniestro '.$request->inputNumeroSiniestro;
                    return view('dyp.nuevoDyp',compact('mensaje'));
                }
            }

            // crea el flujo dyp
            $dyp = new DypFlujos();

            if($request->idCliente) {
                $cliente = Clientes::find($request->idCliente);
                $dyp->ClienteID = $cliente->ID;
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
                    $dyp->ClienteID = $cliente->ID;
                }
            }

            // si no hay rut de cliente,  igual se guarda los datos en el flujo sin asignar el cliente aún
            $dyp->ClienteNombre = $request->inputNombreCliente;
            $dyp->ClienteApellido = $request->inputApellidoCliente;
            $dyp->ClienteEmail = $request->inputEmailCliente;
            $dyp->ClienteTelefono = $request->inputTelefonoCliente;
            $dyp->ClienteTelefono2 = $request->inputTelefono2Cliente;
            $dyp->ClienteTelefono3 = $request->inputTelefono3Cliente;


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
                $dyp->VehiculoId = $vehiculofind->ID;
            }


            $marca = Marca::find($request->inputMarca);
            $modelo = Modelos::find($request->inputModelo);
            $color = $request->inputColor;

            // si está listo el vehículo se procede con el siniestro
            $dyp->Ot_principal = $request->inputNumeroOT;
            $dyp->NumeroSiniestro = $request->inputNumeroSiniestro;
            $dyp->EstadoDyp = "Abierto";
            $dyp->Magnitud = $request->inputMagnitud;
            $dyp->CompaniaSeguro = $request->inputCiaSeguro;
            $dyp->NumeroPoliza = $request->inputNumPoliza;
            $dyp->FechaEmisionPoliza = $request->inputFechaEmision;
            //$dyp->PrimaNeta = $request->inputPrimaNeta;
            $dyp->TipoCliente = $request->inputTipoCliente;
            $dyp->SucursalID = $request->inputSucursal;
            $dyp->AsesorID = Auth::user()->ID;
            $dyp->Patente = str_replace('.','',str_replace('-','',$request->inputPatente));
            $dyp->Vin = $request->inputVin;
            $dyp->Marca = $marca->Marca;
            $dyp->Modelo = $modelo->Modelo;
            $dyp->Color = $color;
            $dyp->Cono = null;

            if($dyp->save())
            {
                $mensaje = 'Flujo DYP ('.$dyp->ID.') Creado exitosamente ';
                logDyp('INFO','Nuevo DYP creado exitosamente',$dyp->ID);
                return view('dyp.nuevoDyp',compact('mensaje'));
            }


            $mensaje = 'Flujo DYP no ha sido creado exitosamente ';
            return view('dyp.nuevoDyp',compact('mensaje'));

        }catch (Exception $e)
        {
            $mensaje = 'Flujo DYP no ha sido creado exitosamente : error ('.$e->getMessage().')';
            return view('dyp.nuevoDyp',compact('mensaje'));
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_tiempos()
    {

        return view('dyp.reportes.reporteTiempos');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dyp.edit');
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

        return view('dyp.leerQr');
    }

    public function compruebaQR(Request $request)
    {
        try {
            // Comprueba si es trabajador DYP
            $trabajoDyp = esTrabajadorDyp(Auth::user()->ID);
            if(!$trabajoDyp)
            {
                $salida = [
                    'titulo' => 'No puede realizar trabajos en el vehículo' ,
                    'texto' => 'Ud. No tiene permisos para realizar esta acción.',
                    'icono' => 'warning',
                    'cancelbutton' => false
                ];

                return $salida;
            }

            $explode = explode('|',$request->valor);
            $valorQR = $explode[0];
            if(isset($explode[1])) {
                $idDyp = $explode[1];
            }
            else
            {
                $flujo = DypFlujos::where('Vin',$valorQR)->where('EstadoDyp','Abierto')->first();
                $idDyp = $flujo->ID;
            }

            //$vehiculo = Vehiculos::where('Vin',$valorQR)->first();
            //$dyp = DypFlujos::where('VehiculoID',$vehiculo->ID)->where('EstadoDyp','Abierto')->first();
            $dyp = DypFlujos::where('ID',$idDyp)->where('EstadoDyp','Abierto')->first();

            if($dyp)
            {
                $taller = DypTareas::where('DypID',$dyp->ID)->where('Estado','Abierto')->where('DypTipoID',13)->first();
                if($taller)
                {

                    // si es torre de control,  podrá finalizar el taller para revisar la calidad
                    if($trabajoDyp == 'TORRE DE CONTROL')
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
                                'titulo' => route('tallerdyp',[$taller->ID]),
                                'texto' => '',
                                'icono'=> 'redirect',
                                'cancelbutton' => true

                            ];
                            return $salida;
                        }
                    }


                    //comprueba el tipo de trabajo con el mismo usuario
                    $trabajo = DypTrabajos::where('TareaID',$taller->ID)
                        ->where('TipoTrabajo',$trabajoDyp)->where('Estado',"Comenzado")->first();
                    if($trabajo)
                    {
                        if($trabajo->Estado == 'Comenzado')
                        {
                            if($request->tipo == 'Comprobar')
                            {
                                $salida = [
                                    'titulo' => 'Finalizar el trabajo actual?' ,
                                    'texto' => 'Trabajo de '.$trabajoDyp. ' Iniciado, si prosigue se Finalizará el trabajo actual y pasará al siguiente. Si falta por realizar cancele.',
                                    'icono'=> 'question',
                                    'cancelbutton' => true

                                ];
                            }else
                            {
                                // actualiza para finalizar el trabajo
                                $trabajo->ResolutorID = Auth::user()->ID;
                                $trabajo->FechaTermino = date('Y-m-d H:i:s');
                                $trabajo->Estado = 'Terminado';
                                logDyp('INFO','Trabajo finalizado',$dyp->ID,$taller->ID);
                            }

                        }else
                        {
                            if($request->tipo == 'Comprobar')
                            {
                                $salida = [
                                    'titulo' => 'Quiere iniciar el trabajo de ('.$trabajoDyp.') ?' ,
                                    'texto' => 'El trabajo de '.$trabajoDyp. ' se iniciará , y comenzará a contabilizar el tiempo abierto, si no quiere iniciar todavía, cancele. ',
                                    'icono'=> 'question',
                                    'cancelbutton' => true

                                ];
                            }else
                            {
                                // crea un nuevo trabajo
                                $trabajo = new DypTrabajos();
                                $trabajo->Estado = 'Comenzado';
                                $trabajo->InicianteID = Auth::user()->ID;
                                $trabajo->FechaInicio = date('Y-m-d H:i:s');
                                logDyp('INFO','Trabajo iniciado',$dyp->ID,$taller->ID);
                            }
                        }
                    }else
                    {
                        if($request->tipo == 'Comprobar')
                        {
                            $salida = [
                                'titulo' => 'Quiere iniciar el trabajo de ('.$trabajoDyp.') ?' ,
                                'texto' => 'El trabajo de '.$trabajoDyp. ' se iniciará , y comenzará a contabilizar el tiempo abierto, si no quiere iniciar todavía, cancele. ',
                                'icono'=> 'question',
                                'cancelbutton' => true

                            ];
                        }else
                        {
                            // crea un nuevo trabajo
                            $trabajo = new DypTrabajos();
                            $trabajo->Estado = 'Comenzado';
                            $trabajo->InicianteID = Auth::user()->ID;
                            $trabajo->FechaInicio = date('Y-m-d H:i:s');
                            logDyp('INFO','Trabajo iniciado',$dyp->ID,$taller->ID);
                        }
                    }

                    if($request->tipo != 'Comprobar')
                    {
                        $trabajo->DypID = $taller->DypID;
                        $trabajo->TareaID = $taller->ID;
                        $trabajo->TipoTrabajo = $trabajoDyp;

                        if($trabajo->save())
                        {
                            // Elimina al vehículo del patio
                            $actualizapatio = DypFlujos::find($dyp->ID);
                            $actualizapatio->Cono = '';
                            $actualizapatio->save();

                            // Finaliza los trabajos y pasa a Control Calidad Si finaliza el Lavado
                            if($trabajoDyp == 'LAVADOR' && $trabajo->Estado == 'Terminado')
                            {
                                $FlujoController =  new FlujoController();
                                // enviar a la funcion de completar tarea los datos para pasar a Control de calidad.
                            }

                            $salida = [
                                'titulo' => 'Trabajo actualizado con éxito' ,
                                'texto' => 'Se ha '.$trabajo->Estado. ' el trabajo de tipo ('.$trabajoDyp.')',
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
                    'texto' => 'No se encontró datos del vehículo en Dyp',
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


