<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgendamientoSubTipo extends Model
{
    use HasFactory;
    protected $table = "SIS_AgendamientosSubTipos";
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
        'TipoID',
        'SubTipo'
    ];

}
