<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;

class MkLead extends Model
{
    protected $table = 'MK_Leads';

    protected $fillable = [ 'Contactado' ];

//    protected $connection = 'roma';

    public $timestamps = false;
}
