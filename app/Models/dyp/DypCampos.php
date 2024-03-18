<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypCampos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_Campos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'DypTipoID',
        'Campo',
        'InputName',
        'Tipo',
        'Clase',
        'Placeholder',
        'VarOption',
        'created_at',
        'updated_at',
        'deleted_at',
        'Requerido',
        'Orden'
    ];

}
