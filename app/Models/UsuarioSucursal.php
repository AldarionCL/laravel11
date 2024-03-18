<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsuarioSucursal extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'SucursalID',
        'UsuarioID',
        'Activo',
        'DisponibleLead',
        'CargoID',
        'fechaAsignacion'
    ];
    protected $table = "SIS_UsuariosSucursales";
    protected $primaryKey = "ID";
    protected $connection = 'roma';


}
