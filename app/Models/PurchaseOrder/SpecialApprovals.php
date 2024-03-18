<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class SpecialApprovals extends Model
{
    protected $table = 'OC_special_approvals';
    protected $connection = 'mysql';

    protected $fillable = ['branchOfficeBuyer_id', 'branchOfficeApprover_id', 'level', 'user_id', 'min', 'max'];
}
