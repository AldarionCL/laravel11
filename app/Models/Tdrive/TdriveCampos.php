<?php

namespace App\Models\Tdrive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TdriveCampos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "TDRIVE_Campos";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";
    protected $fillable = [
        'TdriveTipoID',
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
