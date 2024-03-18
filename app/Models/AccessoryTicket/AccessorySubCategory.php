<?php

namespace App\Models\AccessoryTicket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccessorySubCategory extends Model
{
    protected $table = 'TKa_sub_categories';

    protected $fillable = ['name', 'category_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function agents(): HasMany
    {
        return $this->hasMany( AccessoryAgent::class, 'subCategory_id', 'id');
    }
}
