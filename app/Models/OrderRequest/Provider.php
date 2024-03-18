<?php

namespace App\Models\OrderRequest;

use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\PurchaseOrder\PreOcPurchaseOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    protected $table = 'SP_providers';
    protected $connection = 'mysql';


    protected $fillable = [ 'name', 'payment_condition', 'contact', 'address', 'city', 'postal_code', 'phone', 'email' ];


    public function ocPurchaseOrder(): HasMany
    {
        return $this->hasMany( OcPurchaseOrder::class,  'provider', 'id');
    }

    public function preOcPurchaseOrder(): HasMany
    {
        return $this->hasMany( PreOcPurchaseOrder::class,  'provider_id', 'id');
    }
}
