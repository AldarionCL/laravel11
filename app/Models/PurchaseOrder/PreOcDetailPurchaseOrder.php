<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class PreOcDetailPurchaseOrder extends Model
{
    protected $table = 'PR_oc_detail_purchase_orders';

//    protected $connection = 'mysql-pompeyo';

    protected $fillable = [ 'ocCategory_id', 'ocSubCategory_id', 'ocProduct_id', 'quantity', 'unitPrice', 'totalPrice', 'taxAmount', 'tax', 'branch_id', 'ocPurchaseOrder_id' ];
}
