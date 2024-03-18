<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marca extends Model
{
    use HasFactory;
    protected $table = "MA_Marcas";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'Marca',
        'Activo',
        'H_TannerID',
        'H_IntouchID',
        'H_Texto'
    ];


}
