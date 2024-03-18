<?php

namespace App\Models\CallCenterTicket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CallCenterComment extends Model
{
    protected $table = 'TKc_comments';

    protected $fillable = ['detail', 'ticket_id', 'user_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function file(): HasOne
    {
        return $this->hasOne(CallCenterFileComment::class, 'id', 'ticket_id');
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
