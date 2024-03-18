<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;

class SaveEvent extends Model
{
    protected $table = "SIS_Eventos";

    public $timestamps = false;

    protected $fillable = ['FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'ReferenciaID', 'MenuSecundarioID', 'Comentario'];

//    protected $connection = 'roma';
}
