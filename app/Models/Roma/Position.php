<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'MA_Cargos';

    protected $primaryKey = 'ID';

    protected $fillable = ['ID', 'Cargo'];

//    protected $connection = 'roma';
}
