<?php

namespace App\Models\Landbot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatUsed extends Model
{
    protected $table = "LB_chats_used";

    protected $fillable = [ 'chat', 'channel', 'customer_id', 'name_customer', 'attention', 'brand', 'model', 'phone', 'seller_id', 'lead_id' ];
//    protected $connection = 'mysql';

    protected $connection = 'leads';


    public function messages(): HasMany
    {
        return $this->hasMany( MessageUsed::class, 'customer_id', 'customer_id');
    }
}
