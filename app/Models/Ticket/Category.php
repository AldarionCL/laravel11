<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'TK_categories';

    protected $fillable = ['name', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];
}
