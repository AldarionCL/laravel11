<?php

namespace App\Models\CallCenterTicket;

use Illuminate\Database\Eloquent\Model;

class CallCenterCategory extends Model
{
    protected $table = 'TKc_categories';

    protected $fillable = ['name', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];
}
