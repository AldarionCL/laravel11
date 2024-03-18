<?php

namespace App\Models\OperationTicket;

use Illuminate\Database\Eloquent\Model;

class OperationCategory extends Model
{
    protected $table = 'TKo_categories';

    protected $fillable = ['name', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];
}
