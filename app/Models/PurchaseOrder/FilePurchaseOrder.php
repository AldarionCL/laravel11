<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class FilePurchaseOrder extends Model
{
    protected $table = 'OC_file_purchase_orders';
    protected $connection = 'mysql';


    protected $fillable = [ 'url', 'ocPurchaseOrder_id' ];
}
