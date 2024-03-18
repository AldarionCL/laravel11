<?php

namespace App\Models\Landbot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $table = 'LB_chats';
//    protected $connection = 'mysql';

    protected $fillable = [ 'chat', 'channel', 'customer_id', 'name_customer', 'attention', 'brand', 'model', 'phone' ];

    protected $connection = 'leads';

    public function messages(): HasMany
    {
        return $this->hasMany( Message::class, 'customer_id', 'customer_id');
    }
}
