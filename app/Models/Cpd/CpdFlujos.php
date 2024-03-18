<?php

namespace App\Models\Cpd;

use App\Models\Clientes;
use App\Models\dyp\Vehiculos;
use App\Models\Sucursales;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class CpdFlujos extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = "CPD_Flujos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";



    // Relaciones
    public function Cliente()
    {
        return $this->hasOne(Clientes::class, 'ID', 'ClienteID');
    }

    public function Sucursal()
    {
        return $this->hasOne(Sucursales::class, 'ID', 'SucursalID');
    }

    public function Taller()
    {
        return $this->hasOne(Sucursales::class, 'ID', 'TallerID');
    }
    public function Vendedor()
    {
        return $this->hasOne(User::class, 'id', 'VendedorID');
    }

    public function Asesor()
    {
        return $this->hasOne(User::class, 'id', 'AsesorID');
    }

    public function Evaluador()
    {
        return $this->hasOne(User::class, 'id', 'EvaluadorID');
    }

    public function Vehiculo()
    {
        return $this->hasOne(Vehiculos::class, 'ID', 'VehiculoID');
    }

    public function Trabajos()
    {
        return $this->hasMany(CpdTrabajos::class, 'CpdID', 'ID');
    }


}
