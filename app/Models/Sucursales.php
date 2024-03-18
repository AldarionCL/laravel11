<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sucursales extends Model
{
    use HasFactory;

    protected $table = "MA_Sucursales";
    protected $connection = 'roma';
    protected $primaryKey = "ID";

    protected $fillable = [
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'GerenciaID',
        'TipoSucursalID',
        'EmpresaID',
        'Sucursal',
        'Georeferencia',
        'Direccion',
        'Activa',
        'H_TannerID',
        'H_KiaID',
        'H_ForumID',
        'SucursalApc',
        'CanalSucursal',
        'H_Texto',
        'Visible',
        'VisibleOC',
        'ComunaID',
        'RegionID'
    ];


    public function Gerencias()
    {
        return $this->hasOne(Gerencias::class, 'ID', 'GerenciaID');
    }

}
