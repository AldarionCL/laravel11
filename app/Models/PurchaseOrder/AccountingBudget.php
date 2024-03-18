<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class AccountingBudget extends Model
{
    protected $table = "OC_GL_AccountingBudget";
    protected $connection = 'mysql';

    protected $primaryKey = "ID";

    public $timestamps = false;
}
