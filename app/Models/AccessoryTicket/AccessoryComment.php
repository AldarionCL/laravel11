<?php

namespace App\Models\AccessoryTicket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccessoryComment extends Model
{
    protected $table = 'TKa_comments';

    protected $fillable = ['detail', 'ticket_id', 'user_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function file(): HasOne
    {
        return $this->hasOne(AccessoryFileComment::class, 'id', 'ticket_id');
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
