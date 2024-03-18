<?php

namespace App\Models\CallCenterTicket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallCenterFileComment extends Model
{
    protected $table = 'TKc_file_comments';

    protected $fillable = ['url', 'comment_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(CallCenterComment::class);
    }
}
