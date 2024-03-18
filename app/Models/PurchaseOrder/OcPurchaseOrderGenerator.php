<?php

namespace App\Models\PurchaseOrder;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OcPurchaseOrderGenerator extends Model
{
    protected $table = "OC_purchaseordergenerator";
    protected $connection = 'mysql';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }
}
