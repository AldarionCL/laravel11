<?php

namespace App\Models\Tdrive;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TdriveTareas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "TDRIVE_Tareas";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'TdriveID',
        'TdriveTipoID',
        'ResponsableID',
        'ResolutorID',
        'SolicitanteID',
        'FechaSla',
        'CumpleSla',
        'TareaReferenciaID',
        'FechaResolucion',
        'deleted_at',
        'created_at',
        'updated_at',
        'Estado',
    ];

    public function Tipo()
    {
        return $this->hasOne(TdriveTipos::class, 'ID', 'TdriveTipoID');
    }

    public function Datos()
    {
        return $this->hasMany(TdriveDatosTarea::class, 'TareaID', 'ID');
    }

    public function Archivos()
    {
        return $this->hasMany(TdriveArchivos::class, 'TareaID', 'ID');
    }

    public function Responsable()
    {
        return $this->hasOne(User::class, 'ID', 'ResponsableID');
    }
    public function Resolutor()
    {
        return $this->hasOne(User::class, 'ID', 'ResolutorID');
    }

    public function Solicitante()
    {
        return $this->hasOne(User::class, 'ID', 'SolicitanteID');
    }

}
