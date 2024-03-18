<?php

namespace App\Models\AccessoryTicket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessoryFileComment extends Model
{
    protected $table = 'TKa_file_comments';

    protected $fillable = ['url', 'comment_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(AccessoryComment::class);
    }
}
