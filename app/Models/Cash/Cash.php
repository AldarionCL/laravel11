<?php

namespace App\Models\Cash;

use App\Models\Roma\BranchOffice;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cash extends Model
{
    protected $table = 'RC_cashes';

    protected $fillable = [ 'id', 'user_id', 'branch_office_id', 'total', 'comment', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }

    public function branch_office():BelongsTo
    {
        return $this->belongsTo(BranchOffice::class, 'branch_office_id', 'ID');
    }

    public function cashDetails(): HasMany
    {
        return $this->hasMany(CashDetail::class, 'cash_id', 'id');
    }

    public function cashierApprovals(): HasMany
    {
        return $this->hasMany(CashierApprovals::class, 'cash_id', 'id');
    }
}
