<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'MA_PompeyoEmpresas';

    protected $primaryKey = 'ID';

    protected $fillable = ['ID'];

//    protected $connection = 'roma';
}
