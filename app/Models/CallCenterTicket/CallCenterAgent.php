<?php

namespace App\Models\CallCenterTicket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallCenterAgent extends Model
{
    protected $table = 'TKc_agents';

    protected $fillable = ['user_id', 'subCategory_id', 'branch_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class, 'user_id', 'ID');
    }
}
