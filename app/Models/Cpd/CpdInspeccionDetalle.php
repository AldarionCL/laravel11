<?php

namespace App\Models\Cpd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpdInspeccionDetalle extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "CPD_Inspeccion_Detalle";
    protected $connection = 'roma';

    protected $primaryKey = "ID";


}
