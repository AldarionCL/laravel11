<?php

namespace App\Models\dyp;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypTareas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_Tareas";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'DypID',
        'DypTipoID',
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
        return $this->hasOne(DypTipos::class, 'ID', 'DypTipoID');
    }

    public function Datos()
    {
        return $this->hasMany(DypDatosTarea::class, 'TareaID', 'ID');
    }

    public function Archivos()
    {
        return $this->hasMany(DypArchivos::class, 'TareaID', 'ID');
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
