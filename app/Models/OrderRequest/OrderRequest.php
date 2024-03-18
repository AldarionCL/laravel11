<?php

namespace App\Models\OrderRequest;

use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\PurchaseOrder\PreOcPurchaseOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderRequest extends Model
{
    protected $table = 'SP_orders_requests';
    protected $connection = 'mysql';


    protected $fillable = [ 'order_id', 'request_id' ];

    public function ocPurchaseOrder(): HasMany
    {
        return $this->hasMany( OcPurchaseOrder::class, 'id', 'order_id' );
    }

    public function preOcPurchaseOrder(): HasOne
    {
        return $this->hasOne( PreOcPurchaseOrder::class, 'id', 'request_id' );
    }

    public function ocRequestPurchase(): HasOne
    {
        return $this->hasOne( OcOrderRequest::class, 'id', 'request_id' );
    }
}
