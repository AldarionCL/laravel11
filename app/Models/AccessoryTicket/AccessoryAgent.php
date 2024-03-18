<?php

namespace App\Models\AccessoryTicket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AccessoryAgent extends Model
{
    protected $table = 'TKa_agents';

    protected $fillable = ['user_id', 'subCategory_id', 'branch_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function user()
    {
        return $this->belongsTo( User::class, 'user_id', 'ID');
    }
}
