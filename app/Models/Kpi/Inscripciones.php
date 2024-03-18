<?php

namespace App\Models\Kpi;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscripciones extends Model
{
    use HasFactory;

    protected $table = "VT_Inscripciones";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'VentaID',
        'EtapaID',
        'EstadoID',
        'SolicitarInscripcion',
        'Comentario',
        'Patente',
        'PermisoCirculacion',
        'FechaPermisoCirculacion',
        'Inscripcion',
        'FechaInscripcion',
        'PatenteControlNegocio',
        'FechaPatenteControlNegocios',
        'PatenteEnviada',
        'FechaPatenteEnviada',
        'PatenteRecepcionada',
        'FechaPatenteRecepcionada',
        'PatenteEntregada',
        'FechaPatenteEntregada',
        'ClienteInscribe',
        'FechaSolicitudInscripcion',
        'FacturaID',
        'Resciliacion',
        'MotivoResciliacion',
        'FechaEnproceso',
        'PatenteEnProceso',
        'FechaSubidaFei',
    ];

    public function UsuarioCreacion ()
    {
        return $this->hasOne(User::class, 'ID', 'UsuarioCreacionID');
    }
    public function Venta ()
    {
        return $this->hasOne(Ventas::class, 'ID', 'VentaID');
    }
    public function Etapa ()
    {
        return $this->hasOne(InscripcionesEtapas::class, 'ID', 'EtapaID');
    }
    public function Estado ()
    {
        return $this->hasOne(InscripcionesEstados::class, 'ID', 'EstadoID');
    }



}
