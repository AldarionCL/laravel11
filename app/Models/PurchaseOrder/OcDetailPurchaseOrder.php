<?php

namespace App\Models\PurchaseOrder;

use App\Models\OrderRequest\DetailReception;
use App\Models\OrderRequest\OcProduct;
use App\Models\Roma\BranchOffice;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class OcDetailPurchaseOrder extends Model
{
    protected $table = 'OC_detail_purchase_orders';
    protected $connection = 'mysql';

    protected $fillable =  [ 'id', 'ocCategory_id', 'ocSubCategory_id', 'ocProduct_id', 'amount', 'unitPrice', 'totalPrice', 'branch_id', 'ocPurchaseOrder_id', 'description', 'taxAmount', 'taxe', 'typeOfBranch_id', 'section_id' ];

    public function ocPurchaseOrder()
    {
        return $this->belongsTo( OcPurchaseOrder::class, 'ocPurchaseOrder_id', 'id' );
    }

    public function ocProduct()
    {
        return $this->belongsTo( OcProduct::class, 'ocProduct_id', 'id' );
    }

    public function branchOffice()
    {
        return $this->belongsTo( BranchOffice::class, 'branch_id', 'ID');
    }

    public function detailReception()
    {
        return $this->hasMany( DetailReception::class, 'ocDetailOrderRequest', 'id');
    }

    public function tax()
    {
        return $this->hasOne( Taxe::class, 'id', 'taxe');
    }

    public function section()
    {
        return $this->hasOne( Section::class, 'id', 'section_id');
    }
}
