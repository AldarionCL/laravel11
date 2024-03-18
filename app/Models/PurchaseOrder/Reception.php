<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reception extends Model
{
    protected $table = 'OC_receptions';
    protected $connection = 'mysql';

    protected $fillable = [ 'ocOrderRequest_id', 'document' ];

    public function ocPurchaseOrder(): HasOne
    {
        return $this->hasOne( OcPurchaseOrder::class,'id', 'ocOrderRequest_id');
    }

    public function fileReception(): HasOne
    {
        return $this->hasOne( FileReception::class, 'reception_id', 'id');
    }
}
