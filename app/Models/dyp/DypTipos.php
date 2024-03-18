<?php

namespace App\Models\dyp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypTipos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_Tipos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [];

    public function Campos()
    {
        return $this->hasMany(DypCampos::class, 'DypTipoID', 'ID')->orderBy('Orden');
    }

    public function ProximaTarea()
    {
        return $this->hasOne(DypTipos::class, 'ID', 'ProximaTareaID');
    }

}
