<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FilePrePurchaseOrder extends Model
{
    protected $table = 'PR_files';

    public function preOcPurchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PreOcPurchaseOrder::class, 'oc_id', 'id');
    }
}
