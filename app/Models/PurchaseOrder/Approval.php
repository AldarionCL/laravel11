<?php

namespace App\Models\PurchaseOrder;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Approval extends Model
{
    protected $table = 'OC_approvals';
    protected $connection = 'mysql';

    protected $fillable = [ 'ocOrderRequest_id', 'approver_id', 'level', 'state', 'type' ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id', 'ID');
    }
}
