<?php

namespace App\Models\Cash;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierApprovals extends Model
{
    protected $table = 'RC_cashier_approvals';

    protected $fillable = ['cash_id', 'cashier_approver_id', 'level', 'state', 'active'];

    public function user()
    {
        return $this->belongsTo(User::class, 'cashier_approver_id', 'ID');
    }
}
