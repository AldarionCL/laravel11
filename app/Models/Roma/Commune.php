<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'MA_Comunas';

    protected $fillable = [ 'ID', 'Comuna'];
    protected $connection = 'roma';

}
