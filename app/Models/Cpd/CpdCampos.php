<?php

namespace App\Models\Cpd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdCampos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Campos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'CpdTipoID',
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
