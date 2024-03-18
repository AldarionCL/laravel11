<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agendamientos extends Model
{
    use HasFactory;

    protected $connection = 'roma';
    protected $table = "SIS_Agendamientos";
    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'ClienteID',
        'ReferenciaID',
        'TipoID',
        'UsuarioID',
        'EstadoID',
        'Inicio',
        'Termino',
        'Comentario',
        'SubTipoID',
        'ReAgendado',
        'IntouchID',
        'NGuia',
        'Ejecutor'
    ];

    public function Usuario()
    {
        return $this->hasOne(User::class, 'ID', 'UsuarioID');
    }

    public function Cliente()
    {
        return $this->hasOne(Clientes::class, 'ID', 'ClienteID');
    }

    public function AgendamientoTipo()
    {
        return $this->hasOne(AgendamientoTipo::class, 'ID', 'TipoID');
    }

    public function AgendamientoSubTipo()
    {
        return $this->hasOne(AgendamientoSubTipo::class, 'ID', 'SubTipoID');
    }

    public function AgendamientoIntouch()
    {
        return $this->hasOne(IntouchAgendamiento::class, 'id', 'IntouchID');
    }

}
