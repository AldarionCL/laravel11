<?php

namespace App\Models\Cpd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdTareas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Tareas";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'CpdID',
        'CpdTipoID',
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

    public function FlujoCpd()
    {
        return $this->belongsTo(CpdFlujos::class, 'CpdID', 'ID');
    }

    public function Tipo()
    {
        return $this->hasOne(CpdTipos::class, 'ID', 'CpdTipoID');
    }

    public function Datos()
    {
        return $this->hasMany(CpdDatosTarea::class, 'TareaID', 'ID');
    }

    public function Archivos()
    {
        return $this->hasMany(CpdArchivos::class, 'TareaID', 'ID');
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
