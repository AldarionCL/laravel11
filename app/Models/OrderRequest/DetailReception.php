<?php

namespace App\Models\OrderRequest;

use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailReception extends Model
{
    protected $table = 'SP_detail_receptions';
    protected $connection = 'mysql';


    protected $fillable = [ 'ocDetailOrderRequest', 'amount', 'received'];

    public function ocDetailPurchaseOrder(): BelongsTo
    {
        return $this->belongsTo( OcDetailPurchaseOrder::class, 'ocDetailOrderRequest', 'id');
    }
}
