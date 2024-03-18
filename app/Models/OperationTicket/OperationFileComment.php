<?php

namespace App\Models\OperationTicket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OperationFileComment extends Model
{
    protected $table = 'TKo_file_comments';

    protected $fillable = ['url', 'comment_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(OperationComment::class);
    }
}
