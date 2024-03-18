<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class Approver extends Model
{
    protected $table = 'OC_approvers';
    protected $connection = 'mysql';

    protected $fillable = [ 'branchOffice_id', 'level', 'user_id', 'min', 'max' ];


}
