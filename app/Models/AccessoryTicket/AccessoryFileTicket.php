<?php

namespace App\Models\AccessoryTicket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessoryFileTicket extends Model
{
    protected $table = 'TKa_file_tickets';

    protected $fillable = ['url', 'ticket_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(AccessoryTicket::class);
    }
}
