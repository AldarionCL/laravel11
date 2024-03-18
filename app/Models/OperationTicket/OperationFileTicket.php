<?php

namespace App\Models\OperationTicket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OperationFileTicket extends Model
{
    protected $table = 'TKo_file_tickets';

    protected $fillable = ['url', 'ticket_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(OperationTicket::class);
    }
}
