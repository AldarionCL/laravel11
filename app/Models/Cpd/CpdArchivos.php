<?php

namespace App\Models\Cpd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdArchivos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Archivos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'CpdID',
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
        return $this->hasOne(CpdCampos::class, 'ID', 'CampoID');
    }
}
