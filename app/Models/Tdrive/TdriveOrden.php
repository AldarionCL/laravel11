<?php

namespace App\Models\Tdrive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TdriveOrden extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "TDRIVE_Orden";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";
    protected $fillable = [
        'TdriveID',
        'UsuarioID',
        'Danio',
        'Descripción',
        'DesMontar',
        'Mecanica',
        'Pintura',
        'Repuestos'
    ];

}
