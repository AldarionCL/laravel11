<?php

namespace App\Models\Kpi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Canales extends Model
{
    use HasFactory;

    protected $table = "MA_Canales";
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
        'Canal'
    ];


}
