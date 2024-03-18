<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileTicket extends Model
{
    protected $table = 'TK_file_tickets';

    protected $fillable = ['url', 'ticket_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
