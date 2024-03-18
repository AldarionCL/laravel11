<?php

namespace App\Models\Cpd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdTipos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Tipos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [];

    public function Campos()
    {
        return $this->hasMany(CpdCampos::class, 'CpdTipoID', 'ID')->orderBy('Orden');
    }

    public function ProximaTarea()
    {
        return $this->hasOne(CpdTipos::class, 'ID', 'ProximaTareaID');
    }

}
