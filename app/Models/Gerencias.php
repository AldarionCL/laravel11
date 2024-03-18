<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gerencias extends Model
{
    use HasFactory;

    protected $table = "MA_Gerencias";
    protected $primaryKey = "ID";
    protected $connection = 'roma';

    protected $fillable = [
        'ID',
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'UnidadNegocioID',
        'Gerencia',
        'Vehiculos',
        'Activo',
        'Visible',
        'MarcaAsociada'
    ];


}
