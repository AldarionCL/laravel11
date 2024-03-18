<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'MA_Perfiles';

    protected $primaryKey = 'ID';

    protected $fillable = ['ID', 'Perfil'];

//    protected $connection = 'roma';
}
