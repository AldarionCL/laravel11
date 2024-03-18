<?php

namespace App\Models\Cpd;

use App\Models\Tdrive\TdriveFlujos;
use App\Models\Tdrive\TdriveTareas;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Logs";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'Tipo',
        'request',
        'textolog',
        'UsuarioID',
        'TdriveID',
        'TareaID'
    ];

    public function Usuario()
    {
        return $this->hasOne(User::class, 'ID', 'UsuarioID');
    }
    public function Cpd()
    {
        return $this->hasOne(CpdFlujos::class, 'ID', 'CpdID');
    }

    public function Tarea()
    {
        return $this->hasOne(CpdTareas::class, 'ID', 'TareaID');
    }
}
