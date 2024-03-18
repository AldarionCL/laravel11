<?php

namespace App\Models\Cpd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdInspeccion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Inspeccion";
    protected $connection = 'roma';

    protected $primaryKey = "ID";


    public function Detalles()
    {
        return $this->hasMany(CpdInspeccionDetalle::class, 'idInspeccion', 'ID');
    }


}
