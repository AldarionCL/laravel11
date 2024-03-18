<?php

namespace App\Models\CallCenterTicket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallCenterFileTicket extends Model
{
    protected $table = 'TKc_file_tickets';

    protected $fillable = ['url', 'ticket_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(CallCenterTicket::class);
    }
}
