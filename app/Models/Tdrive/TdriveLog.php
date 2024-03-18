<?php

namespace App\Models\Tdrive;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TdriveLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "TDRIVE_Logs";
    protected $connection = 'mysql';

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
    public function Tdrive()
    {
        return $this->hasOne(TdriveFlujos::class, 'ID', 'TdriveID');
    }

    public function Tarea()
    {
        return $this->hasOne(TdriveTareas::class, 'ID', 'TareaID');
    }
}
