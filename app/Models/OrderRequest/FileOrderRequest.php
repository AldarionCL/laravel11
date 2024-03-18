<?php

namespace App\Models\OrderRequest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileOrderRequest extends Model
{
    protected $table = 'SP_file_order_requests';
    protected $connection = 'mysql';


    protected $fillable = ['url', 'ocOrderRequest_id', 'branchOffice_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function orderRequest(): BelongsTo
    {
        return $this->belongsTo(OcOrderRequest::class);
    }
}
