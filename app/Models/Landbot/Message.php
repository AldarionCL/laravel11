<?php

namespace App\Models\Landbot;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'LB_messages';
//    protected $connection = 'mysql';

    protected $fillable = [ 'customer_id', 'author_type', 'message', 'read', 'readed_at', 'file' ];

    protected $dates = ['readed_at'];

    protected $connection = 'leads';

    protected $casts = [
        'message' => 'array'
    ];
}
