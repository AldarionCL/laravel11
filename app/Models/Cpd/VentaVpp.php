<?php

namespace App\Models\Cpd;

use App\Models\Clientes;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\Kpi\Ventas;
use App\Models\Sucursales;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VentaVpp extends Model
{
    use HasFactory;

    protected $table = "VT_Vpp";
    protected $connection = 'roma';
    protected $primaryKey = "ID";

// Relaciones
    public function Cliente()
    {
        return $this->hasOne(Clientes::class, 'ID', 'ClienteID');
    }

    public function Sucursal()
    {
        return $this->hasOne(Sucursales::class, 'ID', 'SucursalTomaID');
    }

    public function Venta()
    {
        return $this->hasOne(Ventas::class, 'ID', 'VentaID');
    }

    public function Vehiculo()
    {
        return $this->hasOne(Vehiculos::class, 'ID', 'VehiculoID');
    }

    public function Tomador()
    {
        return $this->hasOne(TomadorVpp::class, 'ID', 'TomadorID');
    }


    public function Marca()
    {
        return $this->hasOne(Marca::class, 'ID', 'MarcaID');
    }
    public function Modelo()
    {
        return $this->hasOne(Modelos::class, 'ID', 'ModeloID');
    }
}
