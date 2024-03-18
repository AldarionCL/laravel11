<?php

namespace App\Models\Ti;

use App\Models\Roma\BranchOffice;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    protected $fillable = [ 'tiProduct_id', 'user_id', 'branch_id', 'brand', 'serial_number', 'year', 'imei', 'phone_number', 'status', 'origin', 'observation' ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }

    public function branchOffice(): BelongsTo
    {
        return $this->belongsTo(BranchOffice::class, 'branch_id', 'ID');
    }
}
