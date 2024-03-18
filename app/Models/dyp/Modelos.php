<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modelos extends Model
{
    use HasFactory;

    protected $table = "MA_Modelos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'MarcaID',
        'Modelo',
        'Activo',
        'H_TannerID',
        'H_KiaID',
        'H_IntouchID',
        'H_Texto',
        'ActivoUsados',
        'ActivoNuevo',
        'RutaFichaTecnica'
    ];


}
