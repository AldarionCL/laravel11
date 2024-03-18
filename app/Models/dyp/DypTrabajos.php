<?php

namespace App\Models\dyp;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypTrabajos extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_Trabajos";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'DypID',
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
        return $this->hasOne(DypTareas::class, 'ID', 'TareaID');
    }

}
