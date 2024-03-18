<?php

namespace App\Models\reception;

use App\Models\Sucursales;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    use HasFactory;

    protected $table = "MA_Visitas";
    protected $primaryKey = "ID";
    protected $connection = 'roma';

    protected $appends = [ 'full_name' ];
    protected $fillable = [
        'ID',
        'ClienteID',
        'Nombres',
        'Apellidos',
        'Email',
        'Telefono',
        'ComunaID',
        'Direccion',
        'FechaCreacion',
        'created_at',
        'updated_at',
        'Rut',
        'UsuarioID',
        'TipoCliente',
        'SucursalID',
        'Fecha_salida',
        'UsuarioSalidaID',
        'Patente',
        'Cantidad',
        'MinutosVisita',
        'retiroPatente'

    ];


    public function getFullNameAttribute()
    {
        return $this->Nombres . ' ' . $this->Apellidos;
    }

    public function Sucursales()
    {
        return $this->hasOne(Sucursales::class, 'ID', 'SucursalID');
    }


}
