<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'OC_gl_Account';

    protected $primaryKey = 'ID';

    public $timestamps = false;
}
