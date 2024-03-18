<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypDatosTarea extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_DatosTareas";
    protected $connection = 'roma';

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
        return $this->hasOne(DypCampos::class, 'ID', 'CampoID');
    }


}
