<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    protected $table = 'TK_sub_categories';

    protected $fillable = ['name', 'category_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function agents(): HasMany
    {
        return $this->hasMany( Agent::class, 'subCategory_id', 'id');
    }
}
