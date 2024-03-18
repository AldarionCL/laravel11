<?php

namespace App\Models\OperationTicket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OperationAgent extends Model
{
    protected $table = 'TKo_agents';

    protected $fillable = ['user_id', 'subCategory_id', 'branch_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class, 'user_id', 'ID');
    }
}
