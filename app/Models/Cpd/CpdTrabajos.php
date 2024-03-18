<?php

namespace App\Models\Cpd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdTrabajos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Trabajos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'CpdID',
        'TareaID',
        'Estado',
        'InicianteID',
        'ResolutorID',
        'FechaInicio',
        'FechaTermino',
        'CumpleSla',
        'CumpleCalidad',
        'deleted_at',
        'created_at',
        'updated_at',
        'TipoTrabajo'
    ];

    public function Trabajador()
    {
        return $this->hasOne(User::class, 'ID', 'InicianteID');
    }

    public function Resolutor()
    {
        return $this->hasOne(User::class, 'ID', 'ResolutorID');
    }

    public function TareaTaller()
    {
        return $this->hasOne(CpdTareas::class, 'ID', 'TareaID');
    }

}
