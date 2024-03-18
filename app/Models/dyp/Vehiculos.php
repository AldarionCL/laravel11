<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculos extends Model
{
    use HasFactory;
    protected $table = "MA_Vehiculos";
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
        'ModeloID',
        'VersionID',
        'Anho',
        'Cajon',
        'Patente',
        'Vin',
        'ColorID',
        'OrigenID',
        'SubOrigenID',
        'Prendado',
        'PrecioLista',
        'PrecioCompra',
        'Kilometraje',
        'EstadoID',
        'MenuSecundarioID',
        'ReferenciaID',
        'Ubicacion',
        'TomadorID',
        'Activo',
        'ModeloTxt',
        'VersionTxt',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function Color()
    {
        return $this->hasOne(ColorMarca::class, 'ID', 'ColorID');
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
