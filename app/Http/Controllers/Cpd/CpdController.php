<?php

namespace App\Http\Controllers\Cpd;

use App\Models\Clientes;
use App\Models\Cpd\VentaVpp;
use App\Models\dyp\ColorMarca;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdTareas;
use App\Models\Cpd\CpdTrabajos;
use App\Models\dyp\Marca;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Modelos;
use App\Models\Kpi\Ventas;
use Dompdf\Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CpdController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('cpd.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarCliente(Request $request, $idCliente)
    {
        $idCpd = $request->idCPD;
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

        $cpd = CpdFlujos::find($idCpd);
        if($request->inputSucursal) $cpd->SucursalID = $request->inputSucursal;
        if($request->nombreInput) $cpd->ClienteNombre = $request->nombreInput;
        if($request->apellidoInput) $cpd->ClienteApellido = $request->apellidoInput;
        if($request->rutInput) $cpd->ClienteRut = $request->rutInput;
        if($request->telefonoInput) $cpd->ClienteTelefono = $request->telefonoInput;
        if($request->emailInput) $cpd->ClienteEmail = $request->emailInput;
        if($request->direccionInput) $cpd->ClienteDireccion = $request->direccionInput;
        $cpd->save();

        logDyp('INFO','Datos de cliente actualizados',$idCpd);

        return redirect(route('flujocpd',[$idCpd]));

    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarVehiculo(Request $request)
    {
        $idCpd = $request->idCPD;
        $cpd = CpdFlujos::find($request->idCPD);

        $cpd->Marca = $request->marcaInput;
        $cpd->Modelo = $request->modeloInput;
        $cpd->Version = $request->versionInput;
        $cpd->Color = $request->colorInput;
        $cpd->Patente = $request->patenteInput;
        $cpd->Vin = $request->vinInput;
        $cpd->Cajon = $request->cajonInput;
        $cpd->Anio = $request->anioInput;
        $cpd->save();
        logCpd('INFO','Datos de vehículo actualizados',$idCpd);

        return redirect(route('flujocpd',[$idCpd]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarSiniestro(Request $request)
    {
        $idCpd = $request->idCPD;

        $update= CpdFlujos::find($idCpd);
        $update->Magnitud = $request->inputMagnitud;
        $update->CompaniaSeguro = $request->inputCiaSeguro;
        $update->TipoCliente = $request->inputTipoCliente;
        $update->Ot_principal = $request->Ot_principal;
        $update->NumeroSiniestro = $request->NumeroSiniestro;
        $update->save();

        logCpd('INFO','Datos de siniestro actualizados',$idCpd);

        return redirect(route('flujocpd',[$idCpd]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Redirect
     */
    public function guardarArchivos(Request $request)
    {
        $formulario = $request->all();
        $idCpd = $request->idCpd;
        $idTarea = $request->inputTarea;
        $tarea = CpdTareas::find($idTarea);

        // guarda los archivos
        foreach($formulario as $key => $valor) {
            if ($request->hasFile($key)) {
                $archivo = subirArchivoCpd($request->file($key), $idTarea, $key);
            }
        }

        logCpd('INFO','Archivos subidos',$idCpd);

        return redirect(route('flujocpd',[$idCpd]));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function creaTareaCPD(Request $request, $idCpd)
    {
        try {
            $nuevaTarea = creaTareaCPD($idCpd,$request->idTarea,'Abierto');
            $cpd = CpdFlujos::find($idCpd);
            $cpd->PasoActual = $request->idTarea;

            // si se crea la tarea de Judicial, lo deja en patio Judicial
            if($nuevaTarea->CpdTipoID == 25)
            {
                $puestos = CpdFlujos::select('Cono')->whereRaw("Cono like '%Judicial%'")->pluck('Cono')->toArray();
                for($i=1;$i<=50;$i++)
                {
                    if(!in_array('Judicial-'.$i,$puestos))
                    {
                        $cpd->Cono = 'Judicial-'.$i;
                        break;
                    }
                }
            }

            $cpd->save();
            logDyp('INFO','Tarea creada',$idCpd,$nuevaTarea->ID);
        }catch (Exception $e)
        {
            dd($e);
        }

        return redirect(route('tareacpd',[$nuevaTarea->ID]));
    }


    public function creaLogCPD(Request $request, $idCpd)
    {
        try {
            if($request->has('textolog'))
            {
                logCpd('COMENTARIO',$request->textolog,$idCpd);
            }

        }catch (Exception $e)
        {
            dd($e);
        }

        if($request->tipoLog == 'comentarioEstado') {
            return redirect(route('estadocpd', [$idCpd]));
        }else{
            return redirect(route('flujocpd', [$idCpd]));
        }
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Crea un nuevo flujo de CPD
        try {
            // Comprueba que el CPD no esté duplicado
            if($request->inputNumeroSiniestro)
            {
                $cpd = CpdFlujos::where('NumeroSiniestro',$request->inputNumeroSiniestro)->where('EstadoCpd','Abierto')->first();

                if ($cpd)
                {
                    $mensaje = 'Flujo CPD ya existe con el numero de siniestro '.$request->inputNumeroSiniestro;
                    return view('cpd.nuevoCpd',compact('mensaje'));
                }
            }

            // crea el flujo cpd
            $cpd = new CpdFlujos();

            if($request->idCliente) {
                $cliente = Clientes::find($request->idCliente);
                $cpd->ClienteID = $cliente->ID;
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
                    $cpd->ClienteID = $cliente->ID;
                }
            }

            // si no hay rut de cliente,  igual se guarda los datos en el flujo sin asignar el cliente aún
            $cpd->ClienteNombre = $request->inputNombreCliente;
            $cpd->ClienteApellido = $request->inputApellidoCliente;
            $cpd->ClienteEmail = $request->inputEmailCliente;
            $cpd->ClienteTelefono = $request->inputTelefonoCliente;
            $cpd->ClienteTelefono2 = $request->inputTelefono2Cliente;
            $cpd->ClienteTelefono3 = $request->inputTelefono3Cliente;


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
                $cpd->VehiculoId = $vehiculofind->ID;
            }


            $marca = Marca::find($request->inputMarca);
            $modelo = Modelos::find($request->inputModelo);
            $color = $request->inputColor;

            // si está listo el vehículo se procede con el siniestro
            $cpd->Ot_principal = $request->inputNumeroOT;
            $cpd->NumeroSiniestro = $request->inputNumeroSiniestro;
            $cpd->EstadoCpd = "Abierto";
            $cpd->Magnitud = $request->inputMagnitud;
            $cpd->CompaniaSeguro = $request->inputCiaSeguro;
            $cpd->NumeroPoliza = $request->inputNumPoliza;
            $cpd->FechaEmisionPoliza = $request->inputFechaEmision;
            //$cpd->PrimaNeta = $request->inputPrimaNeta;
            $cpd->TipoCliente = $request->inputTipoCliente;
            $cpd->Origen = $request->inputTipoCliente;
            $cpd->SucursalID = ( $request->inputSucursal)? $request->inputSucursal : 4;
            $cpd->AsesorID = Auth::user()->ID;
            $cpd->Patente = str_replace('.','',str_replace('-','',$request->inputPatente));
            $cpd->Vin = $request->inputVin;
            $cpd->Marca = $marca->Marca;
            $cpd->Modelo = $modelo->Modelo;
            $cpd->Color = $color;
            $cpd->Cono = null;

            if($cpd->save())
            {
                $mensaje = 'Flujo CPD ('.$cpd->ID.') Creado exitosamente ';
                logCpd('INFO','Nuevo CPD creado exitosamente',$cpd->ID);

                // crea tarea recepcion para el CPD
                $tarea = creaTareaCPD($cpd->ID,3,'Abierto');

                return view('cpd.nuevoCpd',compact('mensaje'));
            }




            $mensaje = 'Flujo CPD no ha sido creado exitosamente ';
            return view('cpd.nuevoCpd',compact('mensaje'));

        }catch (Exception $e)
        {
            $mensaje = 'Flujo CPD no ha sido creado exitosamente : error ('.$e->getMessage().')';
            return view('cpd.nuevoCpd',compact('mensaje'));
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_tiempos()
    {

        return view('cpd.reportes.reporteTiempos');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_comite()
    {
        return view('cpd.reportes.reporteComite');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_mayorista()
    {
        return view('cpd.reportes.reporteMayorista');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_judicial()
    {
        return view('cpd.reportes.reporteJudicial');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_wip()
    {

        return view('cpd.reportes.reporteWip');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function reporte_preparacion()
    {

        return view('cpd.reportes.reportePreparacion');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cpd.edit');
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

        return view('cpd.leerQr');
    }

    public function compruebaQR(Request $request)
    {
        try {

            $explode = explode('estadocpd/',$request->valor);
            if(isset($explode[1])) {
                $idCpd = $explode[1];
            }

            $cpd = CpdFlujos::where('ID',$idCpd)->where('EstadoCpd','Abierto')->first();

            if($cpd) {
                if($request->tipo == 'Comprobar')
                {
                    $salida = [
                        'titulo' => 'Flujo CPD Encontrado',
                        'texto' => 'Desea ir a la pantalla de detalle del estado del flujo?',
                        'icono' => 'question',
                        'cancelbutton' => true
                    ];
                }else if($request->tipo == 'Enviar')
                {
                    $salida = [
                        'titulo' => route('estadocpd',[$idCpd]),
                        'texto' => 'Desea ir a la pantalla de detalle del estado del flujo?',
                        'icono' => 'redirect',
                        'cancelbutton' => false
                    ];
                }

            }else
            {
                $salida = [
                    'titulo' => 'No se ha encontrado datos del vehículo en CPD',
                    'texto' => 'No hay datos registrados de este flujo en el sistema,  compruebe que el código qr es el que corresponde al vehículo.',
                    'icono' => 'warning',
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

    // función para la creación del cpd a travez de un Id de Ventas
    public function crea_cpd_ventas(Request $request)
    {
        try {

            // Comprueba que el CPD no esté duplicado
            if($request->has('idVenta'))
            {
                $cpd = CpdFlujos::where('VentaID',$request->idVenta)->first();
                $ventaVPP = VentaVpp::where('VentaID',$request->idVenta)->first();
                $venta = Ventas::find($request->idVenta);

                if ($cpd)
                {
                    $mensaje = 'Flujo CPD ya existe desde la venta id: '.$request->idVenta;
                    $code= 200;
                    $salida = [
                        'error' => false,
                        'exito' => 'n',
                        'msj'=> $mensaje
                    ];
                    return response()->json($salida, $code);
                }
            }else{
                $mensaje = 'No se ha encontrado un Id de venta';
                $code= 200;
                $salida = [
                    'error' => false,
                    'exito' => 'n',
                    'msj'=> $mensaje
                ];
                return response()->json($salida, $code);
            }

            // crea el flujo cpd
            $cpd = new CpdFlujos();
            $cpd->VentaID = $request->idVenta;

            $cpd->VehiculoID = $ventaVPP->Vehiculo->ID;
            $cpd->VendedorID = $venta->VendedorID;
            $cpd->Vin = $ventaVPP->Vehiculo->Vin;
            $cpd->Marca = $ventaVPP->Marca->Marca;
            $cpd->Modelo = $ventaVPP->ModeloTxt;
            $cpd->Version = @$ventaVPP->Vehiculo->Version->Version;
            $cpd->Color = @$ventaVPP->Vehiculo->Color->Color;
            $cpd->Anio = @$ventaVPP->Anio;
            $cpd->Kilometraje = @$ventaVPP->Kilometraje;
            $cpd->Cajon = $venta->Cajon;
            $cpd->PrecioCompra = $ventaVPP->PrecioCompra;

            $cpd->EstadoCpd = "Abierto";
            $cpd->TipoCliente = "Venta VPP";
            $cpd->Patente = str_replace('.','',str_replace('-','',@$ventaVPP->Patente));
            $cpd->SucursalID = $venta->SucursalID;

            $cliente = Clientes::find($ventaVPP->ClienteID);

            if($cliente) {
                $cpd->ClienteID = $cliente->ID;
                $cpd->ClienteRut = trim(str_replace('-','', str_replace('.','',$cliente->Rut)));
                $cpd->ClienteNombre = $cliente->Nombre;
                $cpd->ClienteApellido = $cliente->Apellido." ". $cliente->SegundoApellido;
                $cpd->ClienteEmail = $cliente->Email;
                $cpd->ClienteTelefono = $cliente->Telefono;
                $cpd->ClienteTelefono2 = $cliente->Telefono2;
                $cpd->ClienteTelefono3 = $cliente->Telefono3;
                $cpd->ClienteDireccion = $cliente->Direccion;
            }


            if($cpd->save())
            {
                $mensaje = 'Flujo CPD ('.$cpd->ID.') Creado exitosamente ';
                logCpd('INFO','Nuevo CPD creado exitosamente',$cpd->ID);

                // crea tarea recepcion para el CPD
                $tarea = creaTareaCPD($cpd->ID,1,'Abierto');
            }

            $code= 200;
            $salida = [
                'error' => false,
                'exito' => 's',
                'msj'=> $mensaje
            ];

        }
        catch (Exception $e)
        {
            $mensaje = 'Flujo CPD no ha sido creado exitosamente : error ('.$e->getMessage().')';

            $code= 500;
            $salida = [
                'error' => true,
                'exito' => 'n',
                'msj'=> $mensaje
            ];
        }

        return response()->json($salida, $code);

    }

    public function listo_retiro(Request $request)
    {
        try {
            $mensaje = 'No se ha encontrado un Id de venta';

            if($request->has('idVenta'))
            {
                $cpd = CpdFlujos::where('VentaID',$request->idVenta)->first();

                if ($cpd)
                {
                    // revisa si tiene la tarea 1 creada y la cierra
                    $tarea = CpdTareas::where('CpdID',$cpd->ID)->where('CpdTipoID',1)->where('Estado','Abierto')->first();
                    if($tarea)
                    {
                        $tarea->Estado = 'Resuelto';
                        $tarea->save();
                    }
                    // crea la tarea 2
                    $tarea2 = creaTareaCPD($cpd->ID,2,$tarea->ID,'Abierto');

                    logCpd('INFO','CPD listo para retiro',$cpd->ID);
                    $mensaje = 'CPD listo para retiro';

                    $code= 200;
                    $salida = [
                        'error' => false,
                        'exito' => 's',
                        'msj'=> $mensaje
                    ];

                }
            }else{
                $mensaje = 'No se encontró el flujo de acuerdo al id de la venta';

                $code= 500;
                $salida = [
                    'error' => true,
                    'exito' => 'n',
                    'msj'=> $mensaje
                ];
            }

        }
        catch (Exception $e)
        {
            $mensaje = 'Flujo CPD no pudo ser modificado : error ('.$e->getMessage().')';

            $code= 500;
            $salida = [
                'error' => true,
                'exito' => 'n',
                'msj'=> $mensaje
            ];
        }

        return response()->json($salida, $code);


    }
}


