<?php

namespace App\Models\Tdrive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TdriveTipos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "TDRIVE_Tipos";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";
    protected $fillable = [];

    public function Campos()
    {
        return $this->hasMany(TdriveCampos::class, 'TdriveTipoID', 'ID')->orderBy('Orden');
    }

    public function ProximaTarea()
    {
        return $this->hasOne(TdriveTipos::class, 'ID', 'ProximaTareaID');
    }

}
