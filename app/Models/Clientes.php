<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{
    use HasFactory;

    protected $table = "MA_Clientes";
    protected $connection = 'roma';

    protected $primaryKey = "ID";

    protected $fillable = [
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'Nombre',
        'Rut',
        'Email',
        'Telefono',
        'Direccion',
        'ComunaID',
        'Apellido'
    ];


}
