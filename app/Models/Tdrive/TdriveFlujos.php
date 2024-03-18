<?php

namespace App\Models\Tdrive;

use App\Models\Clientes;
use App\Models\Sucursales;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class TdriveFlujos extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = "TDRIVE_Flujos";
    protected $connection = 'mysql';

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
        return $this->hasMany(TdriveTrabajos::class, 'TdriveID', 'ID');
    }


}
