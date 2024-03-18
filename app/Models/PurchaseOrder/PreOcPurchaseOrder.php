<?php

namespace App\Models\PurchaseOrder;

use App\Models\OrderRequest\Provider;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\Brand;
use App\Models\Roma\Business;
use App\Models\Roma\TypeOfBranche;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PreOcPurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'PR_oc_purchase_orders';

//    protected $connection = 'mysql-pompeyo';

    protected $fillable = [ 'business_id', 'brand_id', 'branch_id', 'typeOfBranch_id', 'state', 'provider_id', 'condition', 'direction', 'commune', 'contact_id', 'oc_id' ];

    public function ocPreDetailPurchaseOrder(): HasMany
    {
        return $this->hasMany( PreOcDetailPurchaseOrder::class, 'ocPurchaseOrder_id', 'id' );
    }

    public function business()
    {
        return $this->belongsTo( Business::class, 'business_id', 'ID');
    }

    public function brand()
    {
        return $this->belongsTo( Brand::class, 'brand_id', 'ID');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo( BranchOffice::class, 'branch_id', 'ID');
    }

    public function typeOfBranch()
    {
        return $this->belongsTo( TypeOfBranche::class, 'typeOfBranch_id', 'ID');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo( Provider::class, 'provider_id', 'id');
    }

    public function preFilePurchaseOrder(): HasOne
    {
        return $this->hasOne( FilePrePurchaseOrder::class, 'oc_id', 'id');
    }
}
