<?php

namespace App\Models\OrderRequest;

use App\Models\PurchaseOrder\Approval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OcDetailOrderRequest extends Model
{
    protected $table = 'SP_oc_detail_order_requests';
    protected $connection = 'mysql';


    protected $fillable = [ 'ocCategory_id', 'ocSubCategory_id', 'unitPrice', 'totalPrice', 'ocProduct_id', 'amount', 'ocOrderRequest_id', 'description' ];

    public function ocOrderRequest(): BelongsTo
    {
        return $this->belongsTo( OcOrderRequest::class, 'ocOrderRequest_id', 'id' );
    }

    public function ocProduct(): BelongsTo
    {
        return $this->belongsTo( OcProduct::class, 'ocProduct_id', 'id' );
    }

    public function approvals(): HasMany
    {
        return $this->hasMany( Approval::class, 'ocOrderRequest_id', 'id');
    }
}
