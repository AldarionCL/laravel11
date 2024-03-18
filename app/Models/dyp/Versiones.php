<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Versiones extends Model
{
    use HasFactory;

    protected $table = "MA_Versiones";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'ModeloID',
        'Version',
        'Activo',
        'H_TannerID',
        'H_KiaID',
        'H_ForumID',
        'ActivoUsados',
        'ActivoNuevo'
    ];


}
