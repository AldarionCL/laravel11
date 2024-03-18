<?php

namespace App\Models\Cash;

use Illuminate\Database\Eloquent\Model;

class FileCash extends Model
{
    protected $table = 'RC_file_cashes';

    protected $fillable = [ 'url', 'cash_detail_id' ];
}
