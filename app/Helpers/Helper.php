<?php

use App\Models\Cargo;
use App\Models\Cpd\CpdArchivos;
use App\Models\Cpd\CpdFlujos;
use App\Models\Cpd\CpdLog;
use App\Models\Cpd\CpdTareas;
use App\Models\Cpd\CpdTipos;
use App\Models\dyp\DypArchivos;
use App\Models\dyp\DypFlujos;
use App\Models\dyp\DypTareas;
use App\Models\dyp\DypTipos;
use App\Models\dyp\DypTrabajos;
use App\Models\OrderRequest\OcCategory;
use App\Models\OrderRequest\OcDetailOrderRequest;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\Perfil;
use App\Models\Sucursales;
use App\Models\Tdrive\TdriveArchivos;
use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTareas;
use App\Models\Tdrive\TdriveTipos;
use App\Models\User;
use App\Models\UsuarioSucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

if (! function_exists('current_user')) {
    function MinutosEntreFechas($fechaini,$fechafin)
    {
        $ini = new DateTime($fechaini);
        $fin = new DateTime($fechafin);
        $diff = $ini->diff($fin);
        if($diff->invert == 0)
            $diferencia = (($diff->d * 1440) + ($diff->h * 60) + ( $diff->i ))*-1;
        else
            $diferencia = ($diff->d * 1440) + ($diff->h * 60) + ( $diff->i );
        return  $diferencia;
    }
}


if (! function_exists('current_user')) {
    function textoMinutos($cantidad,$condensado = 0)
    {
        if($cantidad < 60)
            return ($condensado)? $cantidad." M" : $cantidad." Minutos";
        else
        {
            $horas = floor($cantidad / 60);
            $minutos = $cantidad - ($horas * 60);

            if($horas >= 24)
            {	$dias  = floor($horas / 24);
                $horas = $horas - ($dias * 24);
                return ($condensado)? $dias . " D" : $dias . " dias, " . $horas. " horas, ".$minutos . " minutos";
            }
            else
            {
                return ($condensado)? $horas. " H" :$horas. "h, ".$minutos . "m";
            }

        }
    }
}

if (! function_exists('current_user')) {
    function textoSla($fechaini,$fechafin)
    {
        $minutos = MinutosEntreFechas($fechaini,$fechafin);
        if($minutos > 0)
            return textoMinutos($minutos);
        else
            return 'Excedido';
    }
}

if (! function_exists('creaTareaDYP')) {
    function creaTareaDYP($idDyp,$idTipo,$idTareaRef,$estado="Abierto",$fechaIniSLA ="")
    {
        $dyp = DypFlujos::find($idDyp);
        $tareaTipo = DypTipos::find($idTipo);

        if($fechaIniSLA == "")
            $fechaIniSLA = date('Y-m-d H:i:s');

        $tareaNew = new DypTareas();

        $tareaNew->DypID = $idDyp;
        $tareaNew->DypTipoID = $idTipo;
        $tareaNew->ResponsableID = null;
        $tareaNew->ResolutorID = null;
        $tareaNew->SolicitanteID = Auth::user()->ID;
        // calcula la fecha de sla
        $tareaNew->FechaSla = fechaSLA($tareaTipo->Sla, $fechaIniSLA);
        $tareaNew->CumpleSla = null;
        $tareaNew->TareaReferenciaID = $idTareaRef;
        $tareaNew->Estado = $estado;
        if($tareaNew->save())
        {
            //asigna el responsable
            $responsable = asignaResponsable($tareaNew->ID);
            return $tareaNew;
        }
        else
            return false;

    }
}


if (! function_exists('creaTareaTDRIVE')) {
    function creaTareaTDRIVE($idTdrive,$idTipo,$idTareaRef,$estado="Abierto",$fechaIniSLA ="")
    {
        $tdrive = TdriveFlujos::find($idTdrive);
        $tareaTipo = TdriveTipos::find($idTipo);

        if($fechaIniSLA == "")
            $fechaIniSLA = date('Y-m-d H:i:s');

        $tareaNew = new TdriveTareas();

        $tareaNew->TdriveID = $idTdrive;
        $tareaNew->TdriveTipoID = $idTipo;
        $tareaNew->ResponsableID = null;
        $tareaNew->ResolutorID = null;
        $tareaNew->SolicitanteID = Auth::user()->ID;
        // calcula la fecha de sla
        $tareaNew->FechaSla = fechaSLA($tareaTipo->Sla, $fechaIniSLA);
        $tareaNew->CumpleSla = null;
        $tareaNew->TareaReferenciaID = $idTareaRef;
        $tareaNew->Estado = $estado;
        if($tareaNew->save())
        {
            //asigna el responsable
            $responsable = asignaResponsable($tareaNew->ID);
            return $tareaNew;
        }
        else
            return false;

    }
}

if (! function_exists('creaTareaCPD')) {
    function creaTareaCPD($idCpd,$idTipo,$idTareaRef,$estado="Abierto",$fechaIniSLA ="")
    {

        $tareaTipo = CpdTipos::find($idTipo);

        if($fechaIniSLA == "")
            $fechaIniSLA = date('Y-m-d H:i:s');

        $tareaNew = new CpdTareas();
        $usuario = (isset(Auth::user()->ID))? Auth::user()->ID : 1;

        $tareaNew->CpdID = $idCpd;
        $tareaNew->CpdTipoID = $idTipo;
        $tareaNew->ResponsableID = null;
        $tareaNew->ResolutorID = null;
        $tareaNew->SolicitanteID = $usuario;
        // calcula la fecha de sla
        $tareaNew->FechaSla = fechaSLA($tareaTipo->Sla, $fechaIniSLA);
        $tareaNew->CumpleSla = null;
        $tareaNew->TareaReferenciaID = $idTareaRef;
        $tareaNew->Estado = $estado;
        if($tareaNew->save())
        {
            $cpd = CpdFlujos::find($idCpd);
            $cpd->PasoActual = $idTipo;
            $cpd->save();

            //asigna el responsable
            $responsable = asignaResponsable($tareaNew->ID);
            return $tareaNew;
        }
        else
            return false;

    }
}


if (! function_exists('current_user')) {
    function fechaSLA($minutos,$inicio )
    {

        $fin = date('Y-m-d H:i:s', strtotime($inicio . ' +'.$minutos.' minutes'));
        $listo = false;

        while ($listo == false) {
            if(date('N',strtotime($fin)) == 6 or date('N',strtotime($fin)) == 7)  // se salta los fin de semana
                $fin = date('Y-m-d H:i:s', strtotime($fin . ' + 1 day'));
            elseif(date('G',strtotime($fin))<9) // Horario de inicio a las 9 AM
                $fin = date('Y-m-d H:i:s', strtotime($fin . ' + 1 hour'));
            elseif(date('G',strtotime($fin))>18) // horario fin a las 18 PM
                $fin = date('Y-m-d H:i:s', strtotime($fin . ' + 1 hour'));
            else
                $listo = true;
        }

        return $fin;

    }
}


if (! function_exists('current_user')) {
    function asignaResponsable($idTarea)
    {
        try {
            $tarea = DypTareas::find($idTarea);
            $dyp = DypFlujos::find($tarea->DypID);
            $perfilResponsable = DypTareas::find($idTarea)->Tipo->PerfilResponsable;
            $perfilJefe = DypTareas::find($idTarea)->Tipo->PerfilJefe;
            $perfilDyp = Perfil::where('Perfil','DYP')->first();
            $usuariosDyp = false;

            // Si El perfil responsable es Asesor de servicio, y este ya está asignado al flujo,  se mantiene el mismo
            if($perfilResponsable == 'ASESOR DE SERVICIO' and $dyp->AsesorID != null)
            {
                return $dyp->AsesorID;
            }

            $cargoResponsable = Cargo::where('Cargo',$perfilResponsable)->first();
            if($cargoResponsable) {
                $usuariosDyp = UsuarioSucursal::where('CargoID', $cargoResponsable->ID)
                    ->where('SucursalID', $dyp->SucursalID)
                    ->where('Activo', 1)
                    ->orderBy('fechaAsignacion',)
                    ->first();
            }

            if(!$usuariosDyp)  // si no encuentra responsable, busca jefe
            {
                $cargoJefe = Cargo::where('Cargo',$perfilJefe)->first();
                if($cargoJefe)
                $usuariosDyp = UsuarioSucursal::where('CargoID',$cargoJefe->ID)
                    ->where('SucursalID',$dyp->SucursalID)
                    ->where('Activo',1)
                    ->first();
            }

            if(!$usuariosDyp) { // si no encuentra usuario responsable ni jefe,  en dicha sucursal,  busca responsable en todas
                $usuariosDyp = UsuarioSucursal::where('CargoID', $cargoResponsable->ID)
                    ->where('Activo', 1)
                    ->orderBy('fechaAsignacion',)
                    ->first();
                return $usuariosDyp->UsuarioID;

            }else
            {
                $usuariosDyp->update(array('fechaAsignacion' => date('Y-m-d H:i:s')));
                $tarea->ResponsableID = $usuariosDyp->UsuarioID;
                $tarea->save();
                return $usuariosDyp->UsuarioID;
            }


        }catch (Exception $e)
        {
            return $e->getMessage();
        }

    }
}



if (! function_exists('generarQR')) {
    function generarQR($contenidoQR,$size = 250)
    {
        try {
            $logo = asset('/storage/app/logo.png');
            $data = QrCode::size($size)
                ->generate(
                    $contenidoQR,
                );

            return $data;


        }catch (Exception $e)
        {
            return $e->getMessage();
        }

    }
}



if (! function_exists('subirArchivoDyp')) {
    function subirArchivoDyp($archivo,$tarea,$input)
    {
        try
        {
            $tarea = DypTareas::find($tarea);
            if(!is_array($archivo))
            {
                $archivo = array($archivo);
            }

            foreach ($archivo as $file)
            {
                $name = $file->getClientOriginalName();
                $type = $file->getClientOriginalExtension();
                $size = $file->getSize();
                //$path = Storage::disk('public')->putFileAs('dyp/'.$tarea->DypID, $file, $name);

                if($type == 'gif' || $type == 'jpg' || $type == 'bmp' || $type == 'png')
                {
                    // obtiene ancho y alto de la imagen
                    $height = Image::make($file)->height();
                    $width = Image::make($file)->width();

                    $porcentaje = 640*100/$width;
                    $width = $width*$porcentaje/100;
                    $height = $height*$porcentaje/100;

                    $img = Image::make($file)->resize($width, $height)->encode($type);
                    $path = 'dyp/'.$tarea->DypID."/".$name;
                    $img = Storage::disk('public')->put($path, $img);

                }else
                {
                    $path = Storage::disk('public')->putFileAs('dyp/'.$tarea->DypID, $file, $name);
                }


                $save = new DypArchivos();
                $save->inputName = $input;
                $save->DypID = $tarea->DypID;
                $save->TareaID = $tarea->ID;
                $save->name = $name;
                $save->path = $path;
                $save->size = $size;
                $save->type = $type;
                $save->save();
            }

            return true;
        }catch (\Exception $e)
        {
            dd($e);
            return false;
        }

    }
}



if (! function_exists('subirArchivoCpd')) {
    function subirArchivoCpd($archivo,$tarea,$input)
    {
        try
        {
            $tarea = CpdTareas::find($tarea);
            if(!is_array($archivo))
            {
                $archivo = array($archivo);
            }

            foreach ($archivo as $file)
            {
                $name = $file->getClientOriginalName();
                $type = $file->getClientOriginalExtension();
                $size = $file->getSize();
                //$path = Storage::disk('public')->putFileAs('cpd/'.$tarea->CpdID, $file, $name);

                if($type == 'gif' || $type == 'jpg' || $type == 'bmp' || $type == 'png')
                {
                    // obtiene ancho y alto de la imagen
                    $height = Image::make($file)->height();
                    $width = Image::make($file)->width();

                    $porcentaje = 640*100/$width;
                    $width = $width*$porcentaje/100;
                    $height = $height*$porcentaje/100;

                    $img = Image::make($file)->resize($width, $height)->encode($type);
                    $path = 'cpd/'.$tarea->CpdID."/".$name;
                    $img = Storage::disk('public')->put($path, $img);

                }else
                {
                    $path = Storage::disk('public')->putFileAs('cpd/'.$tarea->CpdID, $file, $name);
                }


                $save = new CpdArchivos();
                $save->inputName = $input;
                $save->CpdID = $tarea->CpdID;
                $save->TareaID = $tarea->ID;
                $save->name = $name;
                $save->path = $path;
                $save->size = $size;
                $save->type = $type;
                $save->save();
            }

            return true;
        }catch (\Exception $e)
        {
            dd($e);
            return false;
        }

    }
}

if (! function_exists('subirArchivoTdrive')) {
    function subirArchivoTdrive($archivo,$tarea,$input)
    {
        try
        {
            $tarea = TdriveTareas::find($tarea);
            if(!is_array($archivo))
            {
                $archivo = array($archivo);
            }

            foreach ($archivo as $file)
            {
                $name = $file->getClientOriginalName();
                $type = $file->getClientOriginalExtension();
                $size = $file->getSize();
                //$path = Storage::disk('public')->putFileAs('tdrive/'.$tarea->TdriveID, $file, $name);

                if($type == 'gif' || $type == 'jpg' || $type == 'bmp' || $type == 'png')
                {
                    // obtiene ancho y alto de la imagen
                    $height = Image::make($file)->height();
                    $width = Image::make($file)->width();

                    $porcentaje = 640*100/$width;
                    $width = $width*$porcentaje/100;
                    $height = $height*$porcentaje/100;

                    $img = Image::make($file)->resize($width, $height)->encode($type);
                    $path = 'tdrive/'.$tarea->TdriveID."/".$name;
                    $img = Storage::disk('public')->put($path, $img);

                }else
                {
                    $path = Storage::disk('public')->putFileAs('tdrive/'.$tarea->TdriveID, $file, $name);
                }


                $save = new TdriveArchivos();
                $save->inputName = $input;
                $save->TdriveID = $tarea->TdriveID;
                $save->TareaID = $tarea->ID;
                $save->name = $name;
                $save->path = $path;
                $save->size = $size;
                $save->type = $type;
                $save->save();
            }

            return true;
        }catch (\Exception $e)
        {
            dd($e);
            return false;
        }

    }
}



if (! function_exists('trabajosDyp')) {
    function trabajosDyp($idDyp)
    {
        try
        {
            $dyp = DypFlujos::find($idDyp);
            if($dyp->Trabajos)
                return $dyp->Trabajos;
            else
                return array();

        }catch (\Exception $e)
        {
            dd($e);
            return array();
        }

    }
}

if (! function_exists('trabajosTdrive')) {
    function trabajosTdrive($idTdrive)
    {
        try
        {
            $Tdrive = TdriveFlujos::find($idTdrive);
            if($Tdrive->Trabajos)
                return $Tdrive->Trabajos;
            else
                return array();

        }catch (\Exception $e)
        {
            dd($e);
            return array();
        }

    }
}



if (! function_exists('trabajosCpd')) {
    function trabajosCpd($idCpd)
    {
        try
        {
            $dyp = CpdFlujos::find($idCpd);
            if($dyp->Trabajos)
                return $dyp->Trabajos;
            else
                return array();

        }catch (\Exception $e)
        {
            dd($e);
            return array();
        }

    }
}

if (! function_exists('esAdicional')) {
    function esAdicional($idTrabajo)
    {
        try
        {
            $trabajo = DypTrabajos::find($idTrabajo);
            $idTallerTrabajo = $trabajo->TareaID;
            $tallerInicial = DypTareas::where('DypID',$trabajo->DypID)->where('DypTipoID',13)->orderBy('ID','asc')->first();

            if($idTallerTrabajo != $tallerInicial->ID)
                return true;
            else
                return false;

        }catch (\Exception $e)
        {
            return false;
        }
    }
}


if (! function_exists('esPerfil')) {
    function esPerfil($perfil)
    {
        try
        {
            $cargoResponsable = Cargo::where('Cargo',$perfil)->first();
            if($cargoResponsable) {
                $usuariosDyp = UsuarioSucursal::where('CargoID', $cargoResponsable->ID)
                    ->where('Activo', 1)
                    ->where('UsuarioID',Auth::user()->ID)
                    ->count();

                if($usuariosDyp>0) {
                    return true;
                }
            }

            return false;
        }catch (\Exception $e)
        {
            return false;
        }

    }
}

if (! function_exists('esTrabajadorDyp')) {
    function esTrabajadorDyp($idUsuario)
    {
        try
        {
            $cargosDYp = Cargo::select(['ID'])->whereIn('Cargo',[
                'ASESOR DE SERVICIO',
                'ANALISTA',
                'ASISTENTE DE PATIO',
                'AUXILIAR DE ASEO',
                'BODEGUERO',
                'CHOFER',
                'COLORISTA',
                'DESABOLLADOR',
                'DESARMADOR/ARMADOR',
                'INSTALADOR',
                'JEFE DE PATIO',
                'MECANICO',
                'PINTOR',
                'PLASTIQUERO',
                'PREPARADOR',
                'PULIDOR',
                'TERMINADOR',
                'TORRE DE CONTROL',
                'LAVADOR',
                'EVALUADOR DE SINIESTROS'
            ])->get()->toArray();

            if($cargosDYp) {
                $usuariosDyp = UsuarioSucursal::select(['CargoID'])
                    ->whereIn('CargoID', $cargosDYp)
                    ->where('Activo', 1)
                    ->where('UsuarioID',Auth::user()->ID)
                    ->get()->toArray();

                if(count($usuariosDyp)>0) {
                    $cargoResponsable = Cargo::find($usuariosDyp[0]["CargoID"]);
                    return $cargoResponsable->Cargo;
                }
            }

            return false;

        }catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }
}



if (! function_exists('esTrabajadorTdrive')) {
    function esTrabajadorTdrive($idUsuario)
    {
        try
        {
            $cargosDYp = Cargo::select(['ID'])->whereIn('Cargo',[
                'ASESOR DE SERVICIO',
                'ANALISTA',
                'ASISTENTE DE PATIO',
                'AUXILIAR DE ASEO',
                'BODEGUERO',
                'CHOFER',
                'COLORISTA',
                'DESABOLLADOR',
                'DESARMADOR/ARMADOR',
                'INSTALADOR',
                'JEFE DE PATIO',
                'MECANICO',
                'PINTOR',
                'PLASTIQUERO',
                'PREPARADOR',
                'PULIDOR',
                'TERMINADOR',
                'TORRE DE CONTROL',
                'LAVADOR',
                'EVALUADOR DE SINIESTROS'
            ])->get()->toArray();

            if($cargosDYp) {
                $usuariosTdrive = UsuarioSucursal::select(['CargoID'])
                    ->whereIn('CargoID', $cargosDYp)
                    ->where('Activo', 1)
                    ->where('UsuarioID',Auth::user()->ID)
                    ->get()->toArray();

                if(count($usuariosTdrive)>0) {
                    $cargoResponsable = Cargo::find($usuariosTdrive[0]["CargoID"]);
                    return $cargoResponsable->Cargo;
                }
            }

            return false;

        }catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }
}



if (! function_exists('esTrabajadorCpd')) {
    function esTrabajadorCpd($idUsuario)
    {
        try
        {
            $cargosCpd = Cargo::select(['ID'])->whereIn('Cargo',[
                'ASESOR DE SERVICIO',
                'ANALISTA',
                'ASISTENTE DE PATIO',
                'AUXILIAR DE ASEO',
                'BODEGUERO',
                'CHOFER',
                'COLORISTA',
                'DESABOLLADOR',
                'DESARMADOR/ARMADOR',
                'INSTALADOR',
                'JEFE DE PATIO',
                'MECANICO',
                'PINTOR',
                'PLASTIQUERO',
                'PREPARADOR',
                'PULIDOR',
                'TERMINADOR',
                'TORRE DE CONTROL',
                'LAVADOR',
                'EVALUADOR DE SINIESTROS'
            ])->get()->toArray();

            if($cargosCpd) {
                $usuariosDyp = UsuarioSucursal::select(['CargoID'])
                    ->whereIn('CargoID', $cargosCpd)
                    ->where('Activo', 1)
                    ->where('UsuarioID',Auth::user()->ID)
                    ->get()->toArray();

                if(count($usuariosDyp)>0) {
                    $cargoResponsable = Cargo::find($usuariosDyp[0]["CargoID"]);
                    return $cargoResponsable->Cargo;
                }
            }

            return false;

        }catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }
}


if (! function_exists('esAdminDyp')) {
function esAdminDyp($idUsuario = '',$tipo = 'verificar')
{
    try
    {
        if($idUsuario == '')
            $idUsuario =Auth::user()->ID;

        $administradores = [
            'gabriel.gomez@pompeyo.cl',
            'alex.campos@pompeyo.cl',
            'jorge.fuentealba@pompeyo.cl'
        ];

        $usuario = User::find($idUsuario);
        if($tipo == 'verificar') {
            if(in_array($usuario->Email, $administradores)) {
                return true;
            }
        }else
        {
            $admins = [];
            foreach($administradores as $administrador)
            {
                $admin = User::select('ID')->where('Email',$administrador)->first();
                if($admin)
                    $admins[] = $admin->ID;
            }
            return $admins;
        }

        return false;

    }catch (\Exception $e)
    {
        return [];
    }

}
}



if (! function_exists('esAdminTdrive')) {
    function esAdminTdrive($idUsuario = '',$tipo = 'verificar')
    {
        try
        {
            if($idUsuario == '')
                $idUsuario =Auth::user()->ID;

            $administradores = [
                'gabriel.gomez@pompeyo.cl',
                'alex.campos@pompeyo.cl',
                'jorge.fuentealba@pompeyo.cl'
            ];

            $usuario = User::find($idUsuario);
            if($tipo == 'verificar') {
                if(in_array($usuario->Email, $administradores)) {
                    return true;
                }
            }else
            {
                $admins = [];
                foreach($administradores as $administrador)
                {
                    $admin = User::select('ID')->where('Email',$administrador)->first();
                    if($admin)
                        $admins[] = $admin->ID;
                }
                return $admins;
            }

            return false;

        }catch (\Exception $e)
        {
            return [];
        }

    }
}




if (! function_exists('esAdminCpd')) {
    function esAdminCpd($idUsuario = '',$tipo = 'verificar')
    {
        try
        {
            if($idUsuario == '')
                $idUsuario =Auth::user()->ID;

            $administradores = [
                'genessis.diaz@pompeyo.cl',
                'christian.alfaro@pompeyo.cl',
                'jorge.fuentealba@pompeyo.cl'
            ];

            $usuario = User::find($idUsuario);
            if($tipo == 'verificar') {
                if(in_array($usuario->Email, $administradores)) {
                    return true;
                }
            }else
            {
                $admins = [];
                foreach($administradores as $administrador)
                {
                    $admin = User::select('ID')->where('Email',$administrador)->first();
                    if($admin)
                        $admins[] = $admin->ID;
                }
                return $admins;
            }

            return false;

        }catch (\Exception $e)
        {
            return [];
        }

    }
}

if (! function_exists('formato_patente')) {

    function formato_patente($patente)
    {
        $explode = str_split(trim($patente));
        if (count($explode) > 4)
            $patentelista = @$explode[0] . @$explode[1] . " • " . @$explode[2] . @$explode[3] . " • " . @$explode[4] . @$explode[5];
        else
            $patentelista = $patente;

        return $patentelista;
    }
}


if (! function_exists('sucursales_servicio')) {

    function sucursales_servicio($modo = 'activo')
    {
        if($modo  == 'activo')
        {
            $sucursales = Sucursales::select(['MA_Sucursales.ID','MA_Sucursales.Sucursal'])
                ->join('SIS_UsuariosSucursales','MA_Sucursales.ID','=','SIS_UsuariosSucursales.SucursalID')
                ->where('SIS_UsuariosSucursales.UsuarioID',Auth::user()->ID)
                ->where('Sucursal','like','%Servicio%')->where('MA_Sucursales.Activa',1)->get()->toArray();
        }
        else
        {
            $sucursales = Sucursales::where('Sucursal','like','%Servicio%')->where('Activa',1)->get()->toArray();
        }

        return $sucursales;
    }
}



if (! function_exists('logDyp')) {

    function logDyp($tipo,$mensaje,$idDyp,$idTarea = null,$request = null)
    {
        try
        {
            $log = new \App\Models\dyp\DypLog();
            $log->DypID = $idDyp;
            $log->TareaID = $idTarea;
            $log->request = $request;
            $log->Tipo = $tipo;
            $log->textolog = $mensaje;
            $log->UsuarioID = Auth::user()->ID;
            $log->save();

            return true;
        }catch (\Exception $e)
        {
            return $e;
        }

    }

}

if (! function_exists('logCpd')) {

    function logCpd($tipo,$mensaje,$idCpd,$idTarea = null,$request = null)
    {
        try
        {
            $log = new CpdLog();
            $log->CpdID = $idCpd;
            $log->TareaID = $idTarea;
            $log->request = $request;
            $log->Tipo = $tipo;
            $log->textolog = $mensaje;
            $log->UsuarioID = Auth::user()->ID;
            $log->save();

            return true;
        }catch (\Exception $e)
        {
            return $e;
        }

    }

}

if (! function_exists('logTdrive')) {

    function logTdrive($tipo,$mensaje,$idTdrive,$idTarea = null,$request = null)
    {
        try
        {
            $log = new \App\Models\Tdrive\TdriveLog();
            $log->TdriveID = $idTdrive;
            $log->TareaID = $idTarea;
            $log->request = $request;
            $log->Tipo = $tipo;
            $log->textolog = $mensaje;
            $log->UsuarioID = Auth::user()->ID;
            $log->save();

            return true;
        }catch (\Exception $e)
        {
            return $e;
        }

    }

}

if (! function_exists('colorEstado')) {

    function colorEstado($estado)
    {
        try
        {
            $color['Abierto'] = 'badge badge-pill badge-warning text-blue-500';
            $color['Postergado'] = 'badge badge-pill badge-secondary text-orange-500';
            $color['Resuelto'] = 'badge badge-pill badge-success text-green-500';
            $color['Rechazado'] = 'badge badge-pill badge-danger text-red-500';

            return $color[$estado];
        }catch (\Exception $e)
        {
            return $e;
        }

    }

}


