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

class TomadorVpp extends Model
{
    use HasFactory;

    protected $table = "MA_TomadorVPP";
    protected $connection = 'roma';
    protected $primaryKey = "ID";

}
