<?php

namespace App\Models\PurchaseOrder;

use App\Models\OrderRequest\OrderRequest;
use App\Models\OrderRequest\Provider;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\Brand;
use App\Models\Roma\Business;
use App\Models\Roma\Commune;
use App\Models\Roma\TypeOfBranche;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OcPurchaseOrder extends Model
{
    protected $table = 'OC_purchase_orders';
    protected $connection = 'mysql';

    protected $fillable = ['id', 'business_id', 'brand_id', 'branch_id', 'typeOfBranch_id', 'buyers_id', 'state', 'provider', 'condition', 'ocOrderRequest_ids', 'direction', 'commune', 'contact_id', 'pre_oc' ];

    public function approvals(): HasMany
    {
        return $this->hasMany( Approval::class, 'ocOrderRequest_id', 'id');
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyers_id', 'ID');
    }

    public function responsible_one(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_one', 'ID');
    }

    public function responsible_two(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_two', 'ID');
    }

    public function ocDetailPurchaseOrder(): HasMany
    {
        return $this->hasMany( OcDetailPurchaseOrder::class, 'ocPurchaseOrder_id', 'id' );
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo( Business::class, 'business_id', 'ID');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo( Brand::class, 'brand_id', 'ID');
    }

    public function branchOffice(): BelongsTo
    {
        return $this->belongsTo( BranchOffice::class, 'branch_id', 'ID');
    }

    public function typeOfBranch(): BelongsTo
    {
        return $this->belongsTo( TypeOfBranche::class, 'typeOfBranch_id', 'ID');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo( Provider::class, 'provider', 'id');
    }

    public function communes(): BelongsTo
    {
        return $this->belongsTo( Commune::class, 'commune', 'ID');
    }

    public function payment(): HasOne
    {
        return $this->hasOne( ConditionPayment::class, 'id', 'condition');
    }

    public function receptionist(): HasOne
    {
        return $this->hasOne( Receptionist::class, 'branchOffice_id', 'branch_id' );
    }

    public function orderRequest(): HasMany
    {
        return $this->hasMany( OrderRequest::class, 'order_id', 'id' );
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo( User::class, 'contact_id', 'ID');
    }

    public function receptions(): HasOne
    {
        return $this->hasOne( Reception::class, 'ocOrderRequest_id', 'id' );
    }
    public function currentApprover(): HasMany
    {
        return $this->approvals()->where('state', 1);
    }

    public function filePurchaseOrder(): HasMany
    {
        return $this->hasMany( FilePurchaseOrder::class, 'ocPurchaseOrder_id', 'id');
    }

    public function scopeOcPurchaseOrderForBranch($query, $branchId, $id )
    {
        return $query->select('id')->where('branch_id', $branchId)->where('id', '<', $id );
    }
}
