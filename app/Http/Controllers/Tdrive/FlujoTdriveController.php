<?php

namespace App\Http\Controllers\Tdrive;

use App\Models\Cargo;
use App\Models\Tdrive\TdriveArchivos;
use App\Models\Tdrive\TdriveCampos;
use App\Models\Tdrive\TdriveDatosTarea;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTareas;
use App\Models\Tdrive\TdriveTrabajos;
use App\Models\dyp\Vehiculos;
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


class FlujoTdriveController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        try {
            $tdrive = TdriveFlujos::find($id);
            $vehiculo = Vehiculos::find($tdrive->VehiculoID);
            return view('tdrive.flujo',compact('id','tdrive','vehiculo'));
        }catch (Exception $e)
        {
            dd($e);
        }

    }

  public function nuevo_tdrive(Request $request)
    {
        $id= 1;
        $tdrive = TdriveFlujos::find($id);
        return view('tdrive.nuevoTdrive',compact('id','tdrive'));
    }


    public function mistareas()
    {

        $tareas = TdriveTareas::where('ResponsableID',Auth::user()->Id)->get();

        $usuariosTdrive = UsuarioSucursal::select(['Cargo','Sucursal'])->where('Activo', 1)
            ->leftjoin('MA_Cargos','MA_Cargos.ID','=','SIS_UsuariosSucursales.CargoID')
            ->leftjoin('MA_Sucursales','MA_Sucursales.ID','=','SIS_UsuariosSucursales.SucursalID')
            ->where('UsuarioID',Auth::user()->ID)
            ->get()->toArray();

        $esTDRIVE = esTrabajadorTdrive(Auth::user()->ID);

        return view('tdrive.mistareas',compact('tareas','usuariosTdrive', 'esTDRIVE'));
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function tarea($id)
    {
        $tarea = TdriveTareas::find($id);
        $tdrive = TdriveFlujos::find($tarea->TdriveID);
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
                ->where('SucursalID', $tdrive->SucursalID)
                ->where('CargoID', $cargo->ID)
                ->where('Activo', 1)->get()->toArray();
        }
        $responsablesID = array_merge(esAdminTdrive('','listar'),$responsablesID);

        $responsables = User::select(['ID','Email'])->whereIn('ID',$responsablesID)->get()->toArray();

        return view('tdrive.tarea',compact('id','tdrive','tarea','motivosRechazo','motivosPosterga','colorEstado','responsables'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function taller($id)
    {

        $tarea = TdriveTareas::find($id);
        $tareaOrdenCIA = TdriveTareas::where('TdriveID',$tarea->TdriveID)->where('TdriveTipoID',7)->where('Estado','Resuelto')->first();
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

        $tdrive = TdriveFlujos::find($tarea->TdriveID);
        $vehiculo = Vehiculos::find($tdrive->VehiculoID);

        return view('tdrive.taller',compact('id','tdrive','tarea','tareaOrdenCIA','camposValores','vehiculo'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function vehiculos_taller(Request $request, $id)
    {
        if($request->has('idTdrive'))
        {
            $idTdrive = $request->idTdrive;
        }
        else {
            $idTdrive = null;
        }
        $sucursal = Sucursales::find($id);

        $error = $request->error;
        $mensaje=$request->mensaje;

        $sucursales = sucursales_servicio();

        return view('tdrive.vehiculosTaller',compact('id','sucursal','idTdrive','error','mensaje','sucursales'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function asignar_puesto(Request $request)
    {
        if(esTrabajadorTdrive(Auth::user()->ID))
        {
            $tdrive = TdriveFlujos::find($request->idTdrive);
            $SucursalID = $tdrive->SucursalID;
            $tdrive->Cono = $request->puesto;
            $error = false;
            $mensaje='';


            if($tdrive->save())
            {
                logTdrive('ASIGNA_PATIO','Puesto '.$request->puesto.'asignado al TDRIVE '.$request->idTdrive,$request->idTdrive);
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
                return \redirect(route('tallertdrive',[$request->idTarea]));
            }

            if($request->has('idTarea'))
            {
                $formulario = $request->all();
                $tarea = TdriveTareas::find($request->idTarea);
                // guarda los archivos
                foreach($formulario as $key => $valor) {
                    if ($request->hasFile($key)) {
                        $archivo = subirArchivoTdrive($request->file($key), $request->idTarea, $key);
                    }
                }

                // guarda los datos de el formulario asignándolos a la tarea
                foreach($formulario as $key => $valor)
                {
                    if ($request->hasFile($key)) {
                        continue;
                    }
                    //busca el campo
                    $campo = TdriveCampos::where('InputName',$key)->where('TdriveTipoID',$tarea->TdriveTipoID)->first();

                    if($campo && $valor != null) {
                        TdriveDatosTarea::create([
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
                    logTdrive('INFO','Tarea '.$tarea->Tipo->NombreTarea.' '.$request->accion,$tarea->TdriveID);

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
                            $tareaNueva = creaTareaTDRIVE($tarea->TdriveID, $tarea->Tipo->tarea_al_rechazar, $tarea->ID, 'Abierto');
                        }
                        else {
                            $tareaNueva = creaTareaTDRIVE($tarea->TdriveID, $tarea->Tipo->ProximaTareaID, $tarea->ID, 'Abierto');
                        }
                        if($tareaNueva)
                        {
                            $mensaje = 'Tarea completada con éxito,   se ha generado una nueva tarea ('.$tarea->Tipo->ProximaTarea->NombreTarea. ')';
                            logTdrive('INFO','Tarea '.$tarea->Tipo->ProximaTarea->NombreTarea.' creada',$tarea->TdriveID);
                        }
                        else
                            $mensaje = 'Tarea completada con éxito,   pero ha habido un problema al generar la nueva tarea';
                    }

                    // Limpia su puesto en el patio si el vehículo es entregado o si se salta a esta parte del flujo
                    if($tarea->TdriveTipoID >= 17 )
                    {
                        $tdrive = TdriveFlujos::find($tarea->TdriveID);
                        $tdrive->Cono = null;
                        $tdrive->save();
                    }

                    // Verifica si es la última tarea del TDRIVE o si se finaliza el flujo para cerrar el TDRIVE
                    if($tarea->TdriveTipoID == 19 || ($tarea->Tipo->Requerimiento == 'CierraFlujo' && $request->accion == 'Rechazado'))
                    {
                        $tdrive = TdriveFlujos::find($tarea->TdriveID);
                        $tdrive->EstadoTdrive = 'Terminado';
                        $tdrive->FechaEntrega = date('Y-m-d H:i:s');
                        $tdrive->save();
                    }

                    // Verifica si se llega al taller ,  y desasigna su puesto en el patio
                    if($tarea->Tipo->ProximaTareaID == 13)
                    {
                        $tdrive = TdriveFlujos::find($tarea->TdriveID);
                        $tdrive->Cono = null;
                        $tdrive->TallerID = $tareaNueva->ID;
                        $tdrive->IngresoTaller = date('Y-m-d H:i:s');
                        $tdrive->save();
                    }

                    // Verifica si el vehículo sale del taller, y desasigna su Id de taller
                    if(isset($tareaNueva) && ($tareaNueva->TdriveTipoID == '14' || $tareaNueva->TdriveTipoID == '21'))
                    {
                        $tdrive = TdriveFlujos::find($tarea->TdriveID);
                        $tdrive->TallerID = null;
                        $tdrive->EgresoTaller = date('Y-m-d H:i:s');
                        $tdrive->save();
                    }

                    // verifica si es la tarea de recepcion, y guarda la OT en el flujo
                    if($tarea->Tipo->ID == 3)
                    {
                        $OT = TdriveDatosTarea::where('TareaID',$tarea->ID)->where('CampoID',72)->first();
                        $magnitud = TdriveDatosTarea::where('TareaID',$tarea->ID)->where('CampoID',95)->first();
                        $tdrive = TdriveFlujos::find($tarea->TdriveID);
                        $tdrive->Ot_principal = $OT->Valor;
                        $tdrive->Magnitud = $magnitud->Valor;
                        $tdrive->save();
                    }

                    // verifica si es la tarea de Ingreso a taller, y guarda la fechaEstimadaEntrega
                    if($tarea->Tipo->ID == 12)
                    {
                        $fecha = TdriveDatosTarea::where('TareaID',$tarea->ID)->where('CampoID',85)->first();
                        $tdrive = TdriveFlujos::find($tarea->TdriveID);
                        $tdrive->FechaEstimadaEntrega = $fecha->Valor;
                        $tdrive->save();
                    }


                    return \redirect(route('flujotdrive',[$tarea->TdriveID]));
                }

            }
        }catch (\Exception $e)
        {
            dd($e);
            $mensaje = 'Ha ocurrido un error al finalizar la tarea: '.$e->getMessage();
            return \redirect(route('flujotdrive',[$tarea->TdriveID,$mensaje]));
        }

        return \redirect(route('tareatdrive',[$request->idTarea]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function reabrirTarea(Request $request,$id)
    {
        try {
            $tarea = TdriveTareas::find($id);
            $tarea->Estado = 'Abierto';
            $tarea->FechaSla = fechaSLA($tarea->Tipo->Sla, date('Y-m-d H:i:s'));
            $tarea->CumpleSla = null;
            $tarea->TareaReabierta = $tarea->TareaReabierta + 1;

            if($tarea->save())
            {
                logTdrive('INFO','Tarea '.$tarea->Tipo->NombreTarea.' reabierta',$tarea->TdriveID,$tarea->ID);
                return \redirect(route('tareatdrive',[$id,'Ok']));
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareatdrive',[$id,$e->getMessage()]));
        }
        return \redirect(route('tareatdrive',[$id]));
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function eliminarTarea(Request $request,$id)
    {
        try {
            $tarea = TdriveTareas::find($id);
            $tarea->Estado = 'Eliminado';

            if($tarea->delete())
            {
                logTdrive('INFO','Tarea '.$tarea->Tipo->NombreTarea.' eliminada',$tarea->TdriveID,$tarea->ID);
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareatdrive',[$id,$e->getMessage()]));
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
            $tarea = TdriveTareas::find($id);
            $tarea->Estado = 'Abierto';
            $tarea->FechaSla = fechaSLA($tarea->Tipo->Sla, date('Y-m-d H:i:s'));
            $tarea->CumpleSla = null;

            if($tarea->save())
            {
                logTdrive('INFO','Tarea '.$tarea->Tipo->NombreTarea.' despostergada',$tarea->TdriveID,$tarea->ID);
                return \redirect(route('tareatdrive',[$id,'Ok']));
            }

        }catch (\Exception $e)
        {
            return \redirect(route('tareatdrive',[$id,$e->getMessage()]));
        }
        return \redirect(route('tareatdrive',[$id]));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Redirect
     */
    public function reasignarResponsable(Request $request)
    {
        try {
            $tarea = TdriveTareas::find($request->idTarea);
            $tarea->ResponsableID = $request->idResponsable;

            if($tarea->save())
            {
                logTdrive('INFO','Tarea '.$tarea->Tipo->NombreTarea.' reasignada al usuario '.$tarea->Responsable->Email,$tarea->TdriveID,$tarea->ID);
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
    public function cambiarFechaEgreso(Request $request,$idTdrive)
    {
        try {

            if($request->has('InputFechaEgreso'))
            {
                $tdrive = TdriveFlujos::find($idTdrive);
                $tdrive->FechaEstimadaEntrega = $request->InputFechaEgreso;
                logTdrive('INFO','Fecha de egreso cambiada de '.date('Y-m-d H:i:s',strtotime( $tdrive->FechaEstimadaEntrega)).' a '.date('Y-m-d H:i:s',strtotime( $request->InputFechaEgreso)),$idTdrive);
                $tdrive->save();
            }

        }catch (\Exception $e)
        {

            return \redirect(route('flujotdrive',[$idTdrive,$e->getMessage()]));
        }
        return \redirect(route('flujotdrive',[$idTdrive]));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tdrive.create');
    }
 public function downloadFile($idArchivo)
    {
        if(esTrabajadorTdrive(Auth::user()->ID))
        {
            $archivo = TdriveArchivos::find($idArchivo);
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
            $taller = TdriveTareas::find($request->idTarea);
            $tdrive = TdriveFlujos::find($taller->TdriveID);

            // registro manual por el Admin
            if($request->has('input_responsable'))
            {
                // crea un nuevo trabajo
                $trabajo = new TdriveTrabajos();
                $trabajo->Estado = 'Terminado';
                $trabajo->InicianteID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                $trabajo->FechaInicio = ($request->has('input_hora_inicio'))? $request->input_hora_inicio : date('Y-m-d H:i:s');
                $trabajo->ResolutorID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                $trabajo->FechaTermino = ($request->has('input_hora_termino'))? $request->input_hora_termino : date('Y-m-d H:i:s');

                $trabajo->TdriveID = $taller->TdriveID;
                $trabajo->TareaID = $taller->ID;
                $trabajo->TipoTrabajo = $request->tipotrabajo;

                if($trabajo->save())
                {
                    return true;
                }
            }

            //comprueba el tipo de trabajo con el mismo usuario
            $trabajo = TdriveTrabajos::where('TareaID',$request->idTarea)
                ->where('TipoTrabajo',$request->tipotrabajo)->where('Estado',"Comenzado")->first();
            if($trabajo)
            {
                if($trabajo->Estado == 'Comenzado')
                {
                    // actualiza para finalizar el trabajo
                    $trabajo->ResolutorID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                    $trabajo->FechaTermino = ($request->has('input_hora_termino'))? $request->input_hora_termino : date('Y-m-d H:i:s');
                    $trabajo->Estado = 'Terminado';

                    logTdrive('INFO','Trabajo '.$trabajo->TipoTrabajo.' finalizado',$taller->TdriveID,$taller->ID);

                }else
                {
                    // crea un nuevo trabajo
                    $trabajo = new TdriveTrabajos();
                    $trabajo->Estado = 'Comenzado';
                    $trabajo->InicianteID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                    $trabajo->FechaInicio = ($request->has('input_hora_inicio'))? $request->input_hora_inicio : date('Y-m-d H:i:s');

                    logTdrive('INFO','Trabajo '.$trabajo->TipoTrabajo.' comenzado',$taller->TdriveID,$taller->ID);
                }
            }else
            {
                $trabajo = new TdriveTrabajos();
                $trabajo->Estado = 'Comenzado';
                $trabajo->InicianteID = ($request->has('input_responsable'))? $request->input_responsable : Auth::user()->ID;
                $trabajo->FechaInicio = ($request->has('input_hora_inicio'))? $request->input_hora_inicio : date('Y-m-d H:i:s');

                logTdrive('INFO','Trabajo '.$trabajo->TipoTrabajo.' comenzado',$taller->TdriveID,$taller->ID);
            }

            $trabajo->TdriveID = $taller->TdriveID;
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
    public function ordenTrabajo($idTdrive)
    {
        $tdrive = TdriveFlujos::find($idTdrive);
        return view('tdrive.ordenTrabajo',compact('idTdrive','tdrive'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
