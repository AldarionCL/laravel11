<?php

namespace App\Models\dyp;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DypLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "DYP_Logs";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'Tipo',
        'request',
        'textolog',
        'UsuarioID',
        'DypID',
        'TareaID'
    ];

    public function Usuario()
    {
        return $this->hasOne(User::class, 'ID', 'UsuarioID');
    }
    public function Dyp()
    {
        return $this->hasOne(DypFlujos::class, 'ID', 'DypID');
    }

    public function Tarea()
    {
        return $this->hasOne(DypTareas::class, 'ID', 'TareaID');
    }
}
