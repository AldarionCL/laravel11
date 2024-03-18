<?php

namespace App\Models\Cash;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CashierApprover extends Model
{
    protected $table = 'RC_cashier_approvers';

    protected $fillable = ['branch_office_id', 'user_id', 'level', 'min', 'max'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }
}
