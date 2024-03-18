<?php

namespace App\Models\OrderRequest;

use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OcCategory extends Model
{
    use HasSku;

    protected $table = 'SP_oc_categories';
    protected $connection = 'mysql';


    protected $fillable = ['name', 'sku', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function ocSubCategories(): HasMany
    {
        return $this->hasMany( OcSubCategory::class, 'ocCategory_id', 'id' );
    }
}
