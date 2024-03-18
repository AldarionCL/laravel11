<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class ApprovalAmount extends Model
{
    protected $table = 'OC_approval_amounts';
    protected $connection = 'mysql';

    protected $fillable = [ 'name', 'amount'];
}
