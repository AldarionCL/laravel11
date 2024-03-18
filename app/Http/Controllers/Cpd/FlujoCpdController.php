<?php

namespace App\Http\Controllers\Cpd;

use App\Models\Cargo;
use App\Models\Cpd\CpdArchivos;
use App\Models\Cpd\CpdCampos;
use App\Models\Cpd\CpdDatosTarea;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdLog;
use App\Models\Cpd\CpdOrden;
use App\Models\Cpd\CpdTareas;
use App\Models\Cpd\CpdTipos;
use App\Models\Cpd\CpdTrabajos;
use App\Models\Cpd\VentaVpp;
use App\Models\dyp\Vehiculos;
use App\Models\OrderRequest\OcCategory;
use App\Models\OrderRequest\OcDetailOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\OrderRequest\OcProduct;
use App\Models\Sucursales;
use App\Models\User;
use App\Models\UsuarioSucursal;
use Dompdf\Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class FlujoCpdController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        try {
            $cpd = CpdFlujos::find($id);
            $vehiculo = Vehiculos::find($cpd->VehiculoID);
            $wips = CpdTipos::where('Requerimiento','WIP')->get();
            $idWip = [];
            foreach($wips as $valor)
            {
                $idWip[] = $valor->ID;
            }
            $tareasWip = CpdTareas::where('CpdID',$id)->whereIn('CpdTipoID',$idWip)->get();
            $wip = [];

            foreach ($tareasWip as $tarea)
            {
                $wip[$tarea->CpdTipoID] = $tarea;
            }
            $idVenta = $cpd->VentaID;
            if($idVenta)
                $idVpp = VentaVpp::where('VentaID',$idVenta)->first();
            else
                $idVpp = 0;

            $tieneInspeccion = CpdTareas::where('CpdID',$id)->where('CpdTipoID',3)->where('Estado','Resuelto')->count();
            $tieneCalidad = CpdTareas::where('CpdID',$id)->where('CpdTipoID',13)->where('Estado','Resuelto')->count();

            return view('cpd.flujo',compact('id','cpd','vehiculo','wip','wips','idVpp','idVenta','tieneCalidad','tieneInspeccion'));
        }catch (Exception $e)
        {
            dd($e);
        }

    }

    public function estado_cpd($id)
    {
        try {
            $cpd = CpdFlujos::find($id);
            $cpdlogs = CpdLog::where('CpdID',$id)->orderBy('created_at','desc')->get();

            if($cpd->EstadoCpd == 'Finalizado')
            {
                return \redirect('https://www.pompeyousados.cl/');
            }
            return view('cpd.estadoCPD',compact('id','cpd','cpdlogs'));
        }catch (Exception $e)
        {
            dd($e);
        }

    }

  public function nuevo_cpd(Request $request)
    {
        $id= 1;
        $cpd = CpdFlujos::find($id);
        return view('cpd.nuevoCpd',compact('id','cpd'));
    }


    public function mistareas()
    {

        $tareas = CpdTareas::where('ResponsableID',Auth::user()->Id)->get();

        $usuariosCpd = UsuarioSucursal::select(['Cargo','Sucursal'])->where('Activo', 1)
            ->leftjoin('MA_Cargos','MA_Cargos.ID','=','SIS_UsuariosSucursales.CargoID')
            ->leftjoin('MA_Sucursales','MA_Sucursales.ID','=','SIS_UsuariosSucursales.SucursalID')
            ->where('UsuarioID',Auth::user()->ID)
            ->get()->toArray();

        $esCPD = esTrabajadorCpd(Auth::user()->ID);

        return view('cpd.mistareas',compact('tareas','usuariosCpd', 'esCPD'));
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function tarea($id)
    {
        $tarea = CpdTareas::find($id);
        $cpd = CpdFlujos::find($tarea->CpdID);
        $cargo = Cargo::where('Cargo',$tarea->Tipo->PerfilResponsable)->first();
/*        dd($cargo, $tarea->Tipo->PerfilResponsable);*/
        $motivosPosterga = array();
        foreach(explode(',',$tarea->Tipo->MotivosPostergacion) as $motivo)
        {
            $motivosPosterga[$motivo] = $motivo;
        }

        $motivosRechazo = array();
        foreach(explode(',',$tarea->Tipo->MotivosRechazo) as $motivo)
        {
            $motivosRechazo[$motivo] = $motivo;
        }

        $colorEstado = 'from-emerald-500 to-teal-400';

        if($tarea->Estado == 'Abierto')
            $colorEstado = 'from-blue-700 to-cyan-500';
        if($tarea->Estado == 'Postergado')
            $colorEstado = 'fr  om-orange-500 to-yellow-500';
        if($tarea->Estado == 'Rechazado')
            $colorEstado = 'from-red-600 to-orange-600';

        // Revisa la lista de responsable segun el cargo de la tarea
        $responsablesID = [];
        if($cargo) {
            $responsablesID = UsuarioSucursal::select(['UsuarioID'])
                ->where('SucursalID', $cpd->SucursalID)
                ->where('CargoID', $cargo->ID)
                ->where('Activo', 1)->get()->toArray();
        }
        $responsablesID = array_merge(esAdminCpd('','listar'),$responsablesID);

        $responsables = User::select(['ID','Email'])->whereIn('ID',$responsablesID)->get()->toArray();

        return view('cpd.tarea',compact('id','cpd','tarea','motivosRechazo','motivosPosterga','colorEstado','responsables'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function wip($id)
    {

        $tarea = CpdTareas::find($id);
        $tareaOrdenCIA = CpdTareas::where('CpdID',$tarea->CpdID)->where('CpdTipoID',7)->where('Estado','Resuelto')->first();
        $camposValores = [
            'valorDesabollador',
            'valorDesabollador',
            'valorPintura',
            'valorPlastico',
            'valorPiezasPulido'
        ];
/*        dd($tareaOrdenCIA->Datos->TipoCampo);*/
        if(!$tareaOrdenCIA)
            $tareaOrdenCIA = array();

        $cpd = CpdFlujos::find($tarea->CpdID);
        $vehiculo = Vehiculos::find($cpd->VehiculoID);
        $wips = CpdTipos::where('Requerimiento','WIP')->pluck('ID');
        $tareasWip = CpdTareas::where('CpdID',$tarea->CpdID)->whereIn('CpdTipoID',$wips)->get();

        return view('cpd.taller',compact('id','cpd','tarea','tareaOrdenCIA','camposValores','vehiculo','tareasWip'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vehiculos_taller(Request $request, $id)
    {
        if($request->has('idCpd'))
        {
            $idCpd = $request->idCpd;
        }
        else {
            $idCpd = null;
        }
        $sucursal = Sucursales::find($id);

        $error = $request->error;
        $mensaje=$request->mensaje;

        $sucursales = sucursales_servicio();

        return view('cpd.vehiculosTaller',compact('id','sucursal','idCpd','error','mensaje','sucursales'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function asignar_puesto(Request $request)
    {
        if(esTrabajadorCpd(Auth::user()->ID))
        {
            $cpd = CpdFlujos::find($request->idCpd);
            $SucursalID = $cpd->SucursalID;
            $cpd->Cono = $request->puesto;
            $error = false;
            $mensaje='';


            if($cpd->save())
            {
                logCpd('ASIGNA_PATIO','Puesto '.$request->puesto.'asignado al CPD '.$request->idCpd,$request->idCpd);
                $mensaje = 'Puesto asignado correctamente';
            }else
            {
                $mensaje= 'Ocurrió un error al asignar';
                $error = true;
            }

        }else{
            $mensaje = 'Ud. no tiene permisos para realizar esta acción';
            $error = true;
            $SucursalID = 206;

        }

        $salida = [
            'mensaje'=> $mensaje,
            'error' => $error,
            'sucursalID' =>$SucursalID
        ];

        return ($salida);
    }


    public function actualizar_puesto(Request $request)
    {
        $puesto = $request->puesto;
        $idCpd = $request->idCpd;

        $sitioUsado = CpdFlujos::where('Cono',$puesto)->count();

        $cpd = CpdFlujos::find($idCpd);
        $cpd->Cono = $puesto;

        if($sitioUsado == 0)
        {
            $cpd->save();
            return 'ok';
        }
        else
        {
            return 'utilizado';
        }

    }

    /**
     * Display a listing of the resource.
     * @return Redirect
     */
    public function completarTarea(Request $request, $id)
    {
        try {
            // consululta si es un trabajo de taller
            if($request->accion == 'Trabajo')
            {
                $this->updateTrabajo($request);
                return \redirect(route('wipcpd',[$request->idTarea]));
            }

            if($request->has('idTarea'))
            {
                $formulario = $request->all();
                $tarea = CpdTareas::find($request->idTarea);
                // guarda los archivos
                foreach($formulario as $key => $valor) {
                    if ($request->hasFile($key)) {
                        $archivo = subirArchivoCpd($request->file($key), $request->idTarea, $key);
                    }
                }


                // verifica si hay Solicitu de orden de compra
                $solicitudOC = $this->creaSolicitudCompraCPD($tarea->ID);
                //dd($solicitudOC);
                if($solicitudOC)
                {
                    // crea los items de la solicitud de compra
                    $verificarOC = $this->verificaDetalleSolicitudCompraCPD($request);
                }

                // guarda los datos de el formulario asignándolos a la tarea
                foreach($formulario as $key => $valor)
                {
                    if ($request->hasFile($key)) {
                        continue;
                    }
                    //busca el campo
                    $campo = CpdCampos::where('InputName',$key)->where('CpdTipoID',$tarea->CpdTipoID)->first();

                    if($campo && $valor != null) {
                        CpdDatosTarea::create([
                            'TareaID' => $request->idTarea,
                            'CampoID' => $campo->ID,
                            'Valor' => $valor
                        ]);
                    }
                }

                // Actualiza la información de la tarea si se resuelve
                if($request->accion == 'Resuelto' || $request->accion == 'Rechazado')
                {
                    $tarea->ResolutorID = Auth::user()->ID;
                    //si tiene sla invertido, cumple sla siempre
                    if($tarea->Tipo->sla_invertido == 1) {
                        $tarea->CumpleSla = 1;
                    } else {
                        //comprueba si cumple el SLA
                        (MinutosEntreFechas($tarea->FechaSla, date('Y-m-d H:i:s')) < 0) ? $tarea->CumpleSla = 0 : $tarea->CumpleSla = 1;
                    }

                    $tarea->FechaResolucion = date('Y-m-d H:i:s');
                }

                // actualiza la información cuando se posterga
                if($request->accion == 'Postergado')
                {
                    $tarea->ResolutorID = Auth::user()->ID;
                    $tarea->FechaPostergacion = $request->fechaPosterga;
                    $tarea->updated_at =  date('Y-m-d H:i:s');
                }

                // actualiza la info
                $tarea->Estado = $request->accion;

                if($tarea->save())
                {
                    logCpd('INFO','Tarea '.$tarea->Tipo->NombreTarea.' '.$request->accion,$tarea->CpdID);


                    // Si se finaliza la tarea de Mayorista, se retira el vehículo del patio
                    if($tarea->CpdTipoID == 26 ) {

                        $cpd = CpdFlujos::find($tarea->CpdID);
                        $cpd->Cono = null;
                        $cpd->save();

                        $tareasAbiertas = CpdTareas::where('CpdID',$tarea->CpdID)->where('Estado','Abierto')->get();
                        foreach($tareasAbiertas as $tareasAbierta)
                        {
                            $postergar = CpdTareas::find($tareasAbierta->ID);
                            $postergar->Estado = 'Postergado';
                            $postergar->save();
                        }

                    }

                    // Vuelve al flujo cuando se resuelve la tarea de Resolver Judicial
                    if($tarea->CpdTipoID == 27 ) {

                        $cpd = CpdFlujos::find($tarea->CpdID);
                        $cpd->EstadoCpd = 'Abierto';
                        $cpd->save();

                        $tareasPostergadas = CpdTareas::where('CpdID',$tarea->CpdID)->where('Estado','Postergado')->get();
                        foreach($tareasPostergadas as $tareaPostergada)
                        {
                            $abrir = CpdTareas::find($tareaPostergada->ID);
                            $abrir->Estado = 'Abierto';
                            $abrir->save();
                        }

                    }

                    // si es retail y vehiculo OK, pasa a WIP, sino pasa a comité.   si es traspaso a tercero y está ok termina flujo y queda en estado traspaso a tercero. si es traspaso a tercero y no está ok, pasa a comité
                    if($tarea->CpdTipoID == 4 )
                    {
                        $cpd = CpdFlujos::find($tarea->CpdID);
                        $cpd->Origen = $request->inputTomador;
                        $cpd->save();

                        if($request->inputVehiculoOk == 'Derivar a Comité')
                        {
                            // pasa a comité.
                            $tareaNueva = creaTareaCPD($tarea->CpdID, 16, $tarea->ID, 'Abierto');
                        }

                        if($cpd->Origen == 'Pompeyo' && $request->inputVehiculoOk == 'Ingresar a Wip')
                        {
                            // pasa a WIP.
                            $tareaNueva = creaTareaCPD($tarea->CpdID, 18, $tarea->ID, 'Abierto');
                            // crea las tareas de WIP
                            $tareaNueva = creaTareaCPD($tarea->CpdID, 5, $tarea->ID, 'Abierto');

                        }



                            if($cpd->Origen == 'Mayorista' && $request->inputVehiculoOk == 'Ingresar a Wip')
                        {
                            // pasa a traspaso a tercero.
                            $cpd->EstadoCpd = 'Mayorista';
                            $cpd->save();
                        }


                    }

                    // verifica si es la tarea de calidad tiene trabajos que no cumplen y crea su WIP correspondiente
                    if($tarea->CpdTipoID == 13 )
                    {
                        $calidadNo = false;
                        $cpd = CpdFlujos::find($tarea->CpdID);

                            if($request->calidadDocumentacion == 'No')
                            {
                                $calidadNo =creaTareaCPD($cpd->ID,5,$tarea->ID);
                            }
                            if($request->calidadMecanica == 'No')
                            {
                                $calidadNo =creaTareaCPD($cpd->ID,6,$tarea->ID);
                            }
                            if($request->calidadRepuestos == 'No')
                            {
                                $calidadNo =creaTareaCPD($cpd->ID,7,$tarea->ID);
                            }
                            if($request->calidadDyp == 'No')
                            {
                                $calidadNo =creaTareaCPD($cpd->ID,8,$tarea->ID);
                            }
                            if($request->calidadPulido == 'No')
                            {
                                $calidadNo =creaTareaCPD($cpd->ID,9,$tarea->ID);
                            }
                            if($request->calidadReparaciones == 'No')
                            {
                                $calidadNo =creaTareaCPD($cpd->ID,22,$tarea->ID);
                            }

                            if($calidadNo)
                            {
                                // crea la tarea WIP
                                creaTareaCPD($cpd->ID,18,$tarea->ID);
                            }

                    }

                    // pasa a mayorista si se escoge
                    if($tarea->CpdTipoID == 16 ) {
                        if($request->inputDefinicion == 'Mayorista')
                        {
                            $cpd = CpdFlujos::find($tarea->CpdID);
                            $cpd->EstadoCpd = 'Mayorista';

                            $tareaNueva = creaTareaCPD($tarea->CpdID, 26, $tarea->ID, 'Abierto');

                            // si se crea la tarea de Mayorista, lo deja en patio mayorista
                            $puestosMayoristas = CpdFlujos::select('Cono')->whereRaw("Cono like '%Mayorista%'")->pluck('Cono')->toArray();
                            for($i=1;$i<=50;$i++)
                            {
                                if(!in_array('Mayoristas-'.$i,$puestosMayoristas))
                                {
                                    $cpd->Cono = 'Mayoristas-'.$i;
                                    break;
                                }
                            }
                            $cpd->save();
                        }
                        else{
                            // pasa a WIP.
                            $tareaNueva = creaTareaCPD($tarea->CpdID, 18, $tarea->ID, 'Abierto');
                            // crea las tareas de WIP
                            $tareaNueva = creaTareaCPD($tarea->CpdID, 5, $tarea->ID, 'Abierto');
                        }
                    }


                    // pasa el vehículo a estado judicial, deteniendo el flujo
                    if($tarea->CpdTipoID == 25 ) {
                        $cpd = CpdFlujos::find($tarea->CpdID);
                        $cpd->EstadoCpd = 'Judicial';
                        $cpd->save();
                    }

                    // verifica si la tarea finaliza el flujo
                    if($tarea->Tipo->Requerimiento == 'Fin flujo')
                    {
                        $cpd = CpdFlujos::find($tarea->CpdID);
                        $cpd->EstadoCpd = 'Finalizado';
                        $cpd->save();
                    }


                    //verifica si hay tarea siguiente y la crea
                    if($tarea->Tipo->ProximaTareaID != null && $tarea->Tipo->ProximaTareaID != 0 && ($request->accion == 'Resuelto' || ($request->accion == 'Rechazado' && $tarea->Tipo->tarea_al_rechazar != 0)))
                    {

                        // verifica si se rechaza, y tiene tarea siguiente al rechazo
                        if($request->accion == 'Rechazado' && $tarea->Tipo->tarea_al_rechazar != 0) {
                            $tareaNueva = creaTareaCPD($tarea->CpdID, $tarea->Tipo->tarea_al_rechazar, $tarea->ID, 'Abierto');
                        }
                        else {
                            $tareaNueva = creaTareaCPD($tarea->CpdID, $tarea->Tipo->ProximaTareaID, $tarea->ID, 'Abierto');
                        }
                        if($tareaNueva) {
                            $mensaje = 'Tarea completada con éxito,   se ha generado una nueva tarea (' . $tarea->Tipo->ProximaTarea->NombreTarea . ')';
                            logCpd('INFO', 'Tarea ' . $tarea->Tipo->ProximaTarea->NombreTarea . ' creada', $tarea->CpdID);
                        }
                    else{
                        $mensaje = 'Tarea completada con éxito,   pero ha habido un problema al generar la nueva tarea';
                        }
                    }

                    return \redirect(route('flujocpd',[$tarea->CpdID]));
                }

            }
        }catch (\Exception $e)
        {
            $mensaje = 'Ha ocurrido un error al finalizar la tarea: '.$e->getMessage();
            return \redirect(route('flujocpd',[$tarea->CpdID,$mensaje]));
        }

        return \redirect(route('tareacpd',[$request->idTarea]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function reabrirTarea(Request $request,$id)
    {
        try {
            $tarea = CpdTareas::find($id);
            $tarea->Estado = 'Abierto';
            $tarea->FechaSla = fechaSLA($tarea->Tipo->Sla, date('Y-m-d H:i:s'));
            $tarea->CumpleSla = null;
            $tarea->TareaReabierta = $tarea->TareaReabierta + 1;

            if($tarea->save())
            {
                logCpd('INFO','Tarea '.$tarea->Tipo->NombreTarea.' reabierta',$tarea->CpdID,$tarea->ID);
                return \redirect(route('tareacpd',[$id,'Ok']));
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareacpd',[$id,$e->getMessage()]));
        }
        return \redirect(route('tareacpd',[$id]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function eliminarTarea(Request $request,$id)
    {
        try {
            $tarea = CpdTareas::find($id);
            $tarea->Estado = 'Eliminado';

            if($tarea->delete())
            {
                logCpd('INFO','Tarea '.$tarea->Tipo->NombreTarea.' eliminada',$tarea->CpdID,$tarea->ID);
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareacpd',[$id,$e->getMessage()]));
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function despostergarTarea(Request $request,$id)
    {
        try {
            $tarea = CpdTareas::find($id);
            $tarea->Estado = 'Abierto';
            $tarea->FechaSla = fechaSLA($tarea->Tipo->Sla, date('Y-m-d H:i:s'));
            $tarea->CumpleSla = null;

            if($tarea->save())
            {
                logCpd('INFO','Tarea '.$tarea->Tipo->NombreTarea.' despostergada',$tarea->CpdID,$tarea->ID);
                return \redirect(route('tareacpd',[$id,'Ok']));
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareacpd',[$id,$e->getMessage()]));
        }
        return \redirect(route('tareacpd',[$id]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function reasignarResponsable(Request $request)
    {
        try {
            $tarea = CpdTareas::find($request->idTarea);
            $tarea->ResponsableID = $request->idResponsable;

            if($tarea->save())
            {
                logCpd('INFO','Tarea '.$tarea->Tipo->NombreTarea.' reasignada al usuario '.$tarea->Responsable->Email,$tarea->CpdID,$tarea->ID);
                $salida = [
                    'mensaje' => 'Se ha reasignado al responsable correctamente',
                    'error' => ''
                ];
            }
        }catch (\Exception $e)
        {
            $salida = [
                'mensaje' => 'Ha ocurrido un error al asignar al responsable',
                'error' => $e->getMessage()
            ];
        }

        return $salida;
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cpd.create');
    }
 public function downloadFile($idArchivo)
    {
        if(esTrabajadorCpd(Auth::user()->ID))
        {
            $archivo = CpdArchivos::find($idArchivo);
            return($archivo->path);
            //return Storage::download(storage_path($archivo->path));
        }
        else
            return 'No tiene permisos para acceder al archivo';

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function updateTrabajo(Request $request)
    {
        try {
            $taller = CpdTareas::find($request->idTarea);
            $cpd = CpdFlujos::find($taller->CpdID);

            //comprueba el tipo de trabajo con el mismo usuario
            $trabajo = CpdTrabajos::where('TareaID',$request->idTarea)
                ->where('TipoTrabajo',$request->tipotrabajo)->where('Estado',"Comenzado")->first();
            if($trabajo)
            {
                if($trabajo->Estado == 'Comenzado')
                {
                    // actualiza para finalizar el trabajo
                    $trabajo->ResolutorID = Auth::user()->ID;
                    $trabajo->FechaTermino = date('Y-m-d H:i:s');
                    $trabajo->Estado = 'Terminado';
                    logCpd('INFO','Trabajo '.$trabajo->TipoTrabajo.' finalizado',$taller->CpdID,$taller->ID);

                }else
                {
                    // crea un nuevo trabajo
                    $trabajo = new CpdTrabajos();
                    $trabajo->Estado = 'Comenzado';
                    $trabajo->InicianteID = Auth::user()->ID;
                    $trabajo->FechaInicio = date('Y-m-d H:i:s');
                    logCpd('INFO','Trabajo '.$trabajo->TipoTrabajo.' comenzado',$taller->CpdID,$taller->ID);

                }
            }else
            {
                $trabajo = new CpdTrabajos();
                $trabajo->Estado = 'Comenzado';
                $trabajo->InicianteID = Auth::user()->ID;
                $trabajo->FechaInicio = date('Y-m-d H:i:s');
                logCpd('INFO','Trabajo '.$trabajo->TipoTrabajo.' comenzado',$taller->CpdID,$taller->ID);
            }
            $trabajo->CpdID = $taller->CpdID;
            $trabajo->TareaID = $taller->ID;
            $trabajo->TipoTrabajo = $request->tipotrabajo;

            if($trabajo->save())
            {
                return true;
            }

        }catch (Exception $e)
        {
            return $e->getMessage();
        }

        return false;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function FormularioCalidad(Request $request,$id)
    {
        $cpd = CpdFlujos::find($id);
        return view('cpd.formularioCalidad',compact('id','cpd'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function FormularioInspeccion(Request $request,$id)
    {
        $cpd = CpdFlujos::find($id);
        return view('cpd.formularioInspeccion',compact('id','cpd'));
    }



    public function creaSolicitudCompraCPD($idTarea)
    {
        try
        {
            $tarea = CpdTareas::find($idTarea);

            // si la tarea no es uno de los WIP, no crea la solicitud de compra
            if(!in_array($tarea->CpdTipoID,[5,6,7,8,9]))
                return null;

            $cpd = CpdFlujos::find($tarea->CpdID);
            $ordenTarea = CpdOrden::where('CpdTareaID',$tarea->ID)->first();

            if($ordenTarea)
            {
                return $ordenTarea->ocOrderRequest_id;
            }


            // crea la solicitud de compra con el usuario de Genesis
            $sOC = new OcOrderRequest();
            $sOC->business_id = 3;
            $sOC->brand_id = 4;
            $sOC->branch_id = 184;
            $sOC->typeOfBranch_id = 1;
            $sOC->buyers_id = 1721;
            $sOC->section_id = 1;
            $sOC->state = 1;

            if($sOC->save())
            {
                $ordenCompraCpd = new CpdOrden();
                $ordenCompraCpd->ocOrderRequest_id = $sOC->id;
                $ordenCompraCpd->CpdTareaID = $tarea->ID;
                $ordenCompraCpd->CpdID = $cpd->ID;
                $ordenCompraCpd->UsuarioID = Auth::user()->ID;
                $ordenCompraCpd->save();


                return $sOC->id;
            }else
            {
                return null;
            }


        }catch (\Exception $e)
        {
            return $e;
        }

    }


    public function verificaDetalleSolicitudCompraCPD($request)
    {
        try {
            if($request->idTarea)
            {
                $tarea = CpdTareas::find($request->idTarea);
                $ocID = $this->creaSolicitudCompraCPD($tarea->ID);

                if($tarea->Tipo->ID == 5)
                {
                    $campos  = [
                        'Frenos'=>'Frenos',
                        'Caja de Cambios'=>'Caja',
                        'Motor'=>'Motor',
                        'Embrague'=>'Embrague',
                        'Aire Acondicionado'=>'Aire',
                        'Bateria'=>'Bateria',
                    ];
                }
                if($tarea->Tipo->ID == 6)
                {
                    $campos  = [
                        'Permiso Circulación'=>'Permiso',
                        'Revision Técnica'=>'RevisionTecnica',
                        'Soap'=>'Soap',
                        'Multas'=>'Multas',
                        'Tag'=>'Tag'

                    ];
                }

                if($tarea->Tipo->ID == 7)
                {
                    $campos  = [
                        'Presupuesto'=>'Presupuesto',
                    ];
                }

                if($tarea->Tipo->ID == 8)
                {
                    $campos  = [
                        'Desabolladura'=>'Desabolladura',
                        'Pintura'=>'Pintura'
                    ];
                }

                if($tarea->Tipo->ID == 9)
                {
                    $campos  = [
                        'Pulido'=>'Pulido'
                    ];
                }

                // comprueba que elementos requieren de ser añadidos a la Solicitud OC
                foreach ($campos as $campo)
                {
                    $inputValor = 'inputValor'.$campo;
                    $campoDescripcion = 'inputDescripcion'.$campo;
                    if($request->$inputValor > 0)
                    {
                        $this->creaDetalleSolicitudCompraCPD
                        (
                            $ocID,
                            $campo,
                            1,
                            $request->$inputValor,
                            $request->$campoDescripcion
                        );
                    }
                }

                return true;
            }

        }catch (\Exception $e) {
            return $e;
        }
    }

    public function creaDetalleSolicitudCompraCPD($ocID,$nombreproducto, $cantidad, $precio, $descripcion)
    {
        try
        {

            $ocCategories = OcCategory::where('name','CPD')->first();
            $producto = OcProduct::where('name',$nombreproducto)->first();

            if($producto)
            {
                // Crea el detalle de la solicitud de compra
                $sOCDetalle = new ocDetailOrderRequest();
                $sOCDetalle->ocCategory_id = $ocCategories->id;
                $sOCDetalle->ocSubCategory_id = $producto->ocSubCategory_id;
                $sOCDetalle->ocProduct_id = $producto->id;
                $sOCDetalle->amount = $cantidad;
                $sOCDetalle->unitPrice = $precio;
                $sOCDetalle->totalPrice = $precio * $cantidad;
                $sOCDetalle->ocOrderRequest_id = $ocID;
                $sOCDetalle->state = 0;
                $sOCDetalle->description = $descripcion;
                $sOCDetalle->save();
            }

        }catch (\Exception $e)
        {
            return $e;
        }

    }

    public function getOptions(Request $request,$id)
    {
        $campo = CpdCampos::find($id);
        $seleccion = $request->seleccion;
        $conjuntos = explode('/',$campo->VarOption);
        $opciones  = array();

        foreach($conjuntos as $conjunto)
        {
            $val = explode('|',$conjunto);
            $opciones[$val[0]] = $val[1];
        }
        $salida = explode(',',$opciones[$seleccion]);

        /*if($campo->Clase != null)
        {
            $salida = explode(',',$campo->Opciones);
        }*/

        return $salida;
    }

    public function eliminarTrabajo(Request $request)
    {
        try {
            $trabajo = CpdTrabajos::find($request->idTrabajo);
            $trabajo->delete();
            logCpd('INFO','Trabajo '.$trabajo->TipoTrabajo.' eliminado',$trabajo->CpdID,$trabajo->ID);

            return 'success';

        }catch (\Exception $e)
        {
            return 'error';
        }
    }


}
