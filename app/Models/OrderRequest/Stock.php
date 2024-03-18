<?php

namespace App\Models\OrderRequest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $table = 'SP_stocks';
    protected $connection = 'mysql';


    protected $fillable = [ 'ocCategory_id', 'ocSubCategory_id', 'ocProduct_id', 'amount', 'unitPrice', 'totalPrice', 'ocOrderRequest_id', 'state', 'description' ];

    public function ocProduct(): BelongsTo
    {
        return $this->belongsTo( OcProduct::class, 'ocProduct_id', 'id');
    }
}
