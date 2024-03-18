<?php

namespace App\Models\Cash;

use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    protected $table = 'RC_cash_accounts';

    protected $fillable = [ 'name' ];
}
