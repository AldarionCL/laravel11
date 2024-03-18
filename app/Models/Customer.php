<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $primaryKey = 'ID';
    protected $table = "MA_Clientes";

    protected $fillable = [ 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID', 'Nombre', 'Rut', 'Email', 'Telefono', 'FechaNacimiento', 'Direccion', 'ComunaID', 'RegionID', 'EstadoCivilID', 'ProfesionID', 'created_at', 'updated_at', 'deleted_at'];
}
