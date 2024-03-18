<?php

namespace App\Models\OrderRequest;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class
OcSubCategory extends Model
{
    use HasSku;

    protected $table = 'SP_oc_sub_categories';
    protected $connection = 'mysql';


    protected $fillable = [ 'name', 'sku', 'ocCategory_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID' ];

    public function ocProducts(): HasMany
    {
        return $this->hasMany( OcProduct::class, 'id', 'ocSubCategory_id');
    }

    public function ocCategory(): BelongsTo
    {
        return $this->belongsTo( OcCategory::class, 'ocCategory_id', 'id');
    }

}
