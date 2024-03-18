<?php

namespace App\Models\Tdrive;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TdriveTrabajos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "TDRIVE_Trabajos";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";
    protected $fillable = [
        'TdriveID',
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
        return $this->hasOne(TdriveTareas::class, 'ID', 'TareaID');
    }

}
