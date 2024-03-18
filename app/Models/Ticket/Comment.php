<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    protected $table = 'TK_comments';

    protected $fillable = ['detail', 'ticket_id', 'user_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function file(): HasOne
    {
        return $this->hasOne(FileComment::class);
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }
}
