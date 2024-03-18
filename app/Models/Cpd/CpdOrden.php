<?php

namespace App\Models\Cpd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdOrden extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Orden";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'CpdID',
        'CpdTareaID',
        'ocOrderRequest_id',
        'UsuarioID',
        'Descripcion',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
