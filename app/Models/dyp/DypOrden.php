<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypOrden extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_Orden";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'DypID',
        'UsuarioID',
        'Danio',
        'Descripción',
        'DesMontar',
        'Mecanica',
        'Pintura',
        'Repuestos'
    ];

}
