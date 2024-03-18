<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgendamientoTipo extends Model
{
    use HasFactory;
    protected $table = "SIS_AgendamientosTipos";
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
        'Tipo',
        'MenuSecundarioID',
        'Activo'
    ];

}
