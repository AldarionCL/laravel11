<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileComment extends Model
{
    protected $table = 'TK_file_comments';

    protected $fillable = ['url', 'comment_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
