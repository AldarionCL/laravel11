<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;

class TypeOfBranche extends Model
{
    protected $table = "MA_TipoSucursal";
    protected $connection = 'roma';

    protected $primaryKey = 'ID';

    protected $fillable = ['ID', 'TipoSucursal'];

//    protected $connection = 'roma';
}
