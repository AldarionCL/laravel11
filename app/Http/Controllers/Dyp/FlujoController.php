<?php

namespace App\Http\Controllers\Dyp;

use App\Models\Cargo;
use App\Models\dyp\DypArchivos;
use App\Models\dyp\DypCampos;
use App\Models\dyp\DypDatosTarea;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypOrden;
use App\Models\dyp\DypTareas;
use App\Models\dyp\DypTrabajos;
use App\Models\dyp\Vehiculos;
use App\Models\Kpi\Ventas;
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


class FlujoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        try {
            $dyp = DypFlujos::find($id);

            $vehiculo = Vehiculos::find($dyp->VehiculoID);
            return view('dyp.flujo',compact('id','dyp','vehiculo'));
        }catch (Exception $e)
        {
            dd($e);
        }

    }



  public function nuevo_dyp(Request $request)
    {
        $id= 1;
        $dyp = DypFlujos::find($id);
        return view('dyp.nuevoDyp',compact('id','dyp'));
    }


    public function mistareas()
    {

        $tareas = DypTareas::where('ResponsableID',Auth::user()->Id)->get();

        $usuariosDyp = UsuarioSucursal::select(['Cargo','Sucursal'])->where('Activo', 1)
            ->leftjoin('MA_Cargos','MA_Cargos.ID','=','SIS_UsuariosSucursales.CargoID')
            ->leftjoin('MA_Sucursales','MA_Sucursales.ID','=','SIS_UsuariosSucursales.SucursalID')
            ->where('UsuarioID',Auth::user()->ID)
            ->get()->toArray();

        $esDYP = esTrabajadorDyp(Auth::user()->ID);

        return view('dyp.mistareas',compact('tareas','usuariosDyp', 'esDYP'));
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function tarea($id)
    {
        $tarea = DypTareas::find($id);
        $dyp = DypFlujos::find($tarea->DypID);
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
                ->where('SucursalID', $dyp->SucursalID)
                ->where('CargoID', $cargo->ID)
                ->where('Activo', 1)->get()->toArray();
        }
        $responsablesID = array_merge(esAdminDyp('','listar'),$responsablesID);

        $responsables = User::select(['ID','Email'])->whereIn('ID',$responsablesID)->get()->toArray();

        return view('dyp.tarea',compact('id','dyp','tarea','motivosRechazo','motivosPosterga','colorEstado','responsables'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function taller($id)
    {

        $tarea = DypTareas::find($id);
        $tareaOrdenCIA = DypTareas::where('DypID',$tarea->DypID)->where('DypTipoID',7)->where('Estado','Resuelto')->first();
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

        $dyp = DypFlujos::find($tarea->DypID);
        $vehiculo = Vehiculos::find($dyp->VehiculoID);

        return view('dyp.taller',compact('id','dyp','tarea','tareaOrdenCIA','camposValores','vehiculo'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vehiculos_taller(Request $request)
    {
        if($request->has('idDyp'))
        {
            $idDyp = $request->idDyp;
        }
        else {
            $idDyp = null;
        }
        $id =1;
        $sucursal = Sucursales::find(1);

        $error = $request->error;
        $mensaje=$request->mensaje;

        $sucursales = sucursales_servicio();

        return view('dyp.vehiculosTaller',compact('id','sucursal','idDyp','error','mensaje','sucursales'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function asignar_puesto(Request $request)
    {
        if(esTrabajadorDyp(Auth::user()->ID))
        {
            $dyp = DypFlujos::find($request->idDyp);
            $SucursalID = $dyp->SucursalID;
            $dyp->Cono = $request->puesto;
            $error = false;
            $mensaje='';


            if($dyp->save())
            {
                logDyp('ASIGNA_PATIO','Puesto '.$request->puesto.'asignado al DYP '.$request->idDyp,$request->idDyp);
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
                return \redirect(route('tallerdyp',[$request->idTarea]));
            }

            if($request->has('idTarea'))
            {
                $formulario = $request->all();
                $tarea = DypTareas::find($request->idTarea);
                // guarda los archivos
                foreach($formulario as $key => $valor) {
                    if ($request->hasFile($key)) {
                        $archivo = subirArchivoDyp($request->file($key), $request->idTarea, $key);
                    }
                }

                // guarda los datos de el formulario asignándolos a la tarea
                foreach($formulario as $key => $valor)
                {
                    if ($request->hasFile($key)) {
                        continue;
                    }
                    //busca el campo
                    $campo = DypCampos::where('InputName',$key)->where('DypTipoID',$tarea->DypTipoID)->first();

                    if($campo && $valor != null) {
                        DypDatosTarea::create([
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
                    $tarea->MotivoPosterga = $request->MotivoPosterga;
                }

                // actualiza la información cuando se rechaza
                if($request->accion == 'Rechazado')
                {
                    $tarea->MotivoRechazo = $request->MotivoRechazo;
                }

                // actualiza la info
                $tarea->Estado = $request->accion;

                if($tarea->save())
                {
                    logDyp('INFO','Tarea '.$tarea->Tipo->NombreTarea.' '.$request->accion,$tarea->DypID);

                    // verifica si se especifica que el flujo tiene repuestos
                    if(($tarea->Tipo->ID == 20 || $tarea->Tipo->ID == 8) && $request->requiereRepuesto == 'Si')
                    {
                        $tarea->Tipo->ProximaTareaID = 9;
                    }

                    //verifica si hay tarea siguiente y la crea
                    if($tarea->Tipo->ProximaTareaID != null && $tarea->Tipo->ProximaTareaID != 0 && ($request->accion == 'Resuelto' || ($request->accion == 'Rechazado' && $tarea->Tipo->tarea_al_rechazar != 0)))
                    {
                        // verifica si se rechaza, y tiene tarea siguiente al rechazo
                        if($request->accion == 'Rechazado' && $tarea->Tipo->tarea_al_rechazar != 0) {
                            $tareaNueva = creaTareaDYP($tarea->DypID, $tarea->Tipo->tarea_al_rechazar, $tarea->ID, 'Abierto');
                        }
                        else {
                            $tareaNueva = creaTareaDYP($tarea->DypID, $tarea->Tipo->ProximaTareaID, $tarea->ID, 'Abierto');
                        }
                        if($tareaNueva)
                        {
                            $mensaje = 'Tarea completada con éxito,   se ha generado una nueva tarea ('.$tarea->Tipo->ProximaTarea->NombreTarea. ')';
                            logDyp('INFO','Tarea '.$tarea->Tipo->ProximaTarea->NombreTarea.' creada',$tarea->DypID);
                        }
                        else
                            $mensaje = 'Tarea completada con éxito,   pero ha habido un problema al generar la nueva tarea';
                    }

                    // Limpia su puesto en el patio si el vehículo es entregado o si se salta a esta parte del flujo
                    if($tarea->DypTipoID >= 17 )
                    {
                        $dyp = DypFlujos::find($tarea->DypID);
                        $dyp->Cono = null;
                        $dyp->save();
                    }

                    // Verifica si es la última tarea del DYP o si se finaliza el flujo para cerrar el DYP
                    if($tarea->DypTipoID == 19 || ($tarea->Tipo->Requerimiento == 'CierraFlujo' && $request->accion == 'Rechazado'))
                    {
                        $dyp = DypFlujos::find($tarea->DypID);
                        $dyp->EstadoDyp = 'Terminado';
                        $dyp->FechaEntrega = date('Y-m-d H:i:s');
                        $dyp->save();
                    }

                    // Verifica si se llega al taller ,  y desasigna su puesto en el patio
                    if($tarea->Tipo->ProximaTareaID == 13)
                    {
                        $dyp = DypFlujos::find($tarea->DypID);
                        $dyp->Cono = null;
                        $dyp->TallerID = $tareaNueva->ID;
                        $dyp->IngresoTaller = date('Y-m-d H:i:s');
                        $dyp->save();
                    }

                    // Verifica si el vehículo sale del taller, y desasigna su Id de taller
                    if(isset($tareaNueva) && ($tareaNueva->DypTipoID == '14' || $tareaNueva->DypTipoID == '21'))
                    {
                        $dyp = DypFlujos::find($tarea->DypID);
                        $dyp->TallerID = null;
                        $dyp->EgresoTaller = date('Y-m-d H:i:s');
                        $dyp->save();
                    }

                    // verifica si es la tarea de recepcion, y guarda la OT en el flujo
                    if($tarea->Tipo->ID == 3)
                    {
                        $OT = DypDatosTarea::where('TareaID',$tarea->ID)->where('CampoID',72)->first();
                        $magnitud = DypDatosTarea::where('TareaID',$tarea->ID)->where('CampoID',95)->first();
                        $dyp = DypFlujos::find($tarea->DypID);
                        $dyp->Ot_principal = $OT->Valor;
                        $dyp->Magnitud = $magnitud->Valor;
                        $dyp->save();
                    }

                    // verifica si es la tarea de Ingreso a taller, y guarda la fechaEstimadaEntrega
                    if($tarea->Tipo->ID == 12)
                    {
                        $fecha = DypDatosTarea::where('TareaID',$tarea->ID)->where('CampoID',85)->first();
                        $dyp = DypFlujos::find($tarea->DypID);
                        $dyp->FechaEstimadaEntrega = $fecha->Valor;
                        $dyp->save();
                    }


                    return \redirect(route('flujodyp',[$tarea->DypID]));
                }

            }
        }catch (\Exception $e)
        {
            dd($e);
            $mensaje = 'Ha ocurrido un error al finalizar la tarea: '.$e->getMessage();
            return \redirect(route('flujodyp',[$tarea->DypID,$mensaje]));
        }

        return \redirect(route('tareadyp',[$request->idTarea]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function reabrirTarea(Request $request,$id)
    {
        try {
            $tarea = DypTareas::find($id);
            $tarea->Estado = 'Abierto';
            $tarea->FechaSla = fechaSLA($tarea->Tipo->Sla, date('Y-m-d H:i:s'));
            $tarea->CumpleSla = null;
            $tarea->TareaReabierta = $tarea->TareaReabierta + 1;

            if($tarea->save())
            {
                logDyp('INFO','Tarea '.$tarea->Tipo->NombreTarea.' reabierta',$tarea->DypID,$tarea->ID);
                return \redirect(route('tareadyp',[$id,'Ok']));
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareadyp',[$id,$e->getMessage()]));
        }
        return \redirect(route('tareadyp',[$id]));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function eliminarTarea(Request $request,$id)
    {
        try {
            $tarea = DypTareas::find($id);
            $tarea->Estado = 'Eliminado';

            if($tarea->delete())
            {
                logDyp('INFO','Tarea '.$tarea->Tipo->NombreTarea.' eliminada',$tarea->DypID,$tarea->ID);
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareadyp',[$id,$e->getMessage()]));
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
            $tarea = DypTareas::find($id);
            $tarea->Estado = 'Abierto';
            $tarea->FechaSla = fechaSLA($tarea->Tipo->Sla, date('Y-m-d H:i:s'));
            $tarea->CumpleSla = null;

            if($tarea->save())
            {
                logDyp('INFO','Tarea '.$tarea->Tipo->NombreTarea.' despostergada',$tarea->DypID,$tarea->ID);
                return \redirect(route('tareadyp',[$id,'Ok']));
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareadyp',[$id,$e->getMessage()]));
        }
        return \redirect(route('tareadyp',[$id]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function reasignarResponsable(Request $request)
    {
        try {
            $tarea = DypTareas::find($request->idTarea);
            $tarea->ResponsableID = $request->idResponsable;

            if($tarea->save())
            {
                logDyp('INFO','Tarea '.$tarea->Tipo->NombreTarea.' reasignada al usuario '.$tarea->Responsable->Email,$tarea->DypID,$tarea->ID);
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
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function cambiarFechaEgreso(Request $request,$idDyp)
    {
        try {

            if($request->has('InputFechaEgreso'))
            {
                $dyp = DypFlujos::find($idDyp);
                $dyp->FechaEstimadaEntrega = $request->InputFechaEgreso;
                logDyp('INFO','Fecha de egreso cambiada de '.date('Y-m-d H:i:s',strtotime( $dyp->FechaEstimadaEntrega)).' a '.date('Y-m-d H:i:s',strtotime( $request->InputFechaEgreso)),$idDyp);
                $dyp->save();
            }

        }catch (\Exception $e)
        {

            return \redirect(route('flujodyp',[$idDyp,$e->getMessage()]));
        }
        return \redirect(route('flujodyp',[$idDyp]));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dyp.create');
    }
 public function downloadFile($idArchivo)
    {
        if(esTrabajadorDyp(Auth::user()->ID))
        {
            $archivo = DypArchivos::find($idArchivo);
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
            $taller = DypTareas::find($request->idTarea);
            $dyp = DypFlujos::find($taller->DypID);

            // registro manual por el Admin
            if($request->has('input_responsable'))
            {
                // crea un nuevo trabajo
                $trabajo = new DypTrabajos();
                $trabajo->Estado = 'Terminado';
                $trabajo->InicianteID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                $trabajo->FechaInicio = ($request->has('input_hora_inicio'))? $request->input_hora_inicio : date('Y-m-d H:i:s');
                $trabajo->ResolutorID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                $trabajo->FechaTermino = ($request->has('input_hora_termino'))? $request->input_hora_termino : date('Y-m-d H:i:s');

                $trabajo->DypID = $taller->DypID;
                $trabajo->TareaID = $taller->ID;
                $trabajo->TipoTrabajo = $request->tipotrabajo;

                if($trabajo->save())
                {
                    return true;
                }
            }

            //comprueba el tipo de trabajo con el mismo usuario
            $trabajo = DypTrabajos::where('TareaID',$request->idTarea)
                ->where('TipoTrabajo',$request->tipotrabajo)->where('Estado',"Comenzado")->first();
            if($trabajo)
            {
                if($trabajo->Estado == 'Comenzado')
                {
                    // actualiza para finalizar el trabajo
                    $trabajo->ResolutorID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                    $trabajo->FechaTermino = ($request->has('input_hora_termino'))? $request->input_hora_termino : date('Y-m-d H:i:s');
                    $trabajo->Estado = 'Terminado';

                    logDyp('INFO','Trabajo '.$trabajo->TipoTrabajo.' finalizado',$taller->DypID,$taller->ID);

                }else
                {
                    // crea un nuevo trabajo
                    $trabajo = new DypTrabajos();
                    $trabajo->Estado = 'Comenzado';
                    $trabajo->InicianteID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                    $trabajo->FechaInicio = ($request->has('input_hora_inicio'))? $request->input_hora_inicio : date('Y-m-d H:i:s');

                    logDyp('INFO','Trabajo '.$trabajo->TipoTrabajo.' comenzado',$taller->DypID,$taller->ID);
                }
            }else
            {
                $trabajo = new DypTrabajos();
                $trabajo->Estado = 'Comenzado';
                $trabajo->InicianteID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                $trabajo->FechaInicio = ($request->has('input_hora_inicio'))? $request->input_hora_inicio : date('Y-m-d H:i:s');

                logDyp('INFO','Trabajo '.$trabajo->TipoTrabajo.' comenzado',$taller->DypID,$taller->ID);
            }

            $trabajo->DypID = $taller->DypID;
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
    public function ordenTrabajo($idDyp)
    {
        $dyp = DypFlujos::find($idDyp);
        return view('dyp.ordenTrabajo',compact('idDyp','dyp'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function eliminarDetalleOrden(Request $request)
    {

        // se elimina dato de la tabla DYP_Orden
        $detalleOrden = DypOrden::find($request->id);
        $detalleOrden->forceDelete();

        return 'success';
    }

    public function agregarDetalleOrden(Request $request)
    {
        // se agrega el dato de la tabla DYP_Orden
        $detalleOrden = new DypOrden();
        $detalleOrden->DypID = $request->idDyp;
        $detalleOrden->UsuarioID = Auth::user()->ID;
        $detalleOrden->Danio = $request->inputDanioNew;
        $detalleOrden->Descripcion = $request->inputDescripcionNew;
        $detalleOrden->DesMontar = $request->inputDesMontarNew;
        $detalleOrden->Mecanica = $request->inputMecanicaNew;
        $detalleOrden->Pintura = $request->inputValorPinturaNew;
        $detalleOrden->Repuestos = $request->inputValorRepuestoNew;
        $detalleOrden->save();


        return 'success';


    }

    public function eliminarTrabajo(Request $request)
    {
        try {
            $trabajo = DypTrabajos::find($request->idTrabajo);
            $trabajo->delete();
            logDyp('INFO','Trabajo '.$trabajo->TipoTrabajo.' eliminado',$trabajo->DypID,$trabajo->ID);

            return 'success';

        }catch (\Exception $e)
        {
            return 'error';
        }
    }


    public function actualizar_puesto(Request $request)
    {
        $puesto = $request->puesto;
        $idDyp = $request->idDyp;

        $sitioUsado = DypFlujos::where('Cono',$puesto)->count();

        $dyp = DypFlujos::find($idDyp);
        $dyp->Cono = $puesto;

        if($sitioUsado == 0)
        {
            $dyp->save();
            return 'ok';
        }
        else
        {
            return 'utilizado';
        }

    }
}
