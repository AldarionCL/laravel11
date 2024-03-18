<?php

namespace App\Models\Tdrive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TdriveDatosTarea extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "TDRIVE_DatosTareas";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'TareaID',
        'CampoID',
        'Valor',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function Campos()
    {
        return $this->hasOne(TdriveCampos::class, 'ID', 'CampoID');
    }


}
