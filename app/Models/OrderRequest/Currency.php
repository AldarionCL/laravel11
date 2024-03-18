<?php

namespace App\Models\OrderRequest;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'SP_currencies';
    protected $connection = 'mysql';

}
