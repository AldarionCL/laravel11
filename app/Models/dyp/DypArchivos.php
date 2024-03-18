<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypArchivos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_Archivos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'DypID',
        'TareaID',
        'inputName',
        'path',
        'name',
        'type',
        'size',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function Campos()
    {
        return $this->hasOne(DypCampos::class, 'ID', 'CampoID');
    }
}
