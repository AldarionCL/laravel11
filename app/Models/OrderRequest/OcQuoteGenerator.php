<?php

namespace App\Models\OrderRequest;

use Illuminate\Database\Eloquent\Model;

class OcQuoteGenerator extends Model
{
    protected $table = "SP_oc_quotegenerator";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";
}
