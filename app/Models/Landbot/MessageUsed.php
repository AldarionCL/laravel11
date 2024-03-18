<?php

namespace App\Models\Landbot;

use Illuminate\Database\Eloquent\Model;

class MessageUsed extends Model
{
    protected $table = "LB_messages_used";

    protected $fillable = [ 'customer_id', 'author_type', 'message', 'read', 'readed_at', 'file' ];

    protected $dates = ['readed_at'];
//    protected $connection = 'mysql';

    protected $connection = 'leads';

    protected $casts = [
        'message' => 'array'
    ];
}
