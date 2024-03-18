<?php

namespace App\Models\AccessoryTicket;

use Illuminate\Database\Eloquent\Model;

class AccessoryCategory extends Model
{
    protected $table = 'TKa_categories';

    protected $fillable = ['name', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

}
