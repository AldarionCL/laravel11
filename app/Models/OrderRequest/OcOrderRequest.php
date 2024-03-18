<?php

namespace App\Models\OrderRequest;

use App\Models\PurchaseOrder\Approval;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\Brand;
use App\Models\Roma\Business;
use App\Models\Roma\TypeOfBranche;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OcOrderRequest extends Model
{
    use HasFactory;

    protected $table = 'SP_oc_order_requests';
    protected $connection = 'mysql';


    protected $fillable = [ 'business_id', 'brand_id', 'branch_id', 'typeOfBranch_id', 'buyers_id', 'section_id', 'state' ];

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

    public function responsible_back_office(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_back_office', 'ID');
    }

    public function ocDetailOrderRequest(): HasMany
    {
        return $this->hasMany( OcDetailOrderRequest::class, 'ocOrderRequest_id', 'id' );
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

    public function business(): BelongsTo
    {
        return $this->belongsTo( Business::class, 'business_id', 'ID');
    }

    public function orderRequest(): HasMany
    {
        return $this->hasMany( OrderRequest::class, 'request_id', 'id' );
    }

    public function currentApprover(): HasMany
    {
        return $this->approvals()->where('state', 1);
    }

    public function scopeOcOrderRequestForBranch($query, $branchId, $id )
    {
        return $query->select('id')->where('branch_id', $branchId)->where('id', '<', $id );
    }

    public function section(): HasOne
    {
        return $this->hasOne( Section::class, 'id', 'section_id');
    }
}
