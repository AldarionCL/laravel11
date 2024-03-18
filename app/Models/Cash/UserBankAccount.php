<?php

namespace App\Models\Cash;

use Illuminate\Database\Eloquent\Model;

class UserBankAccount extends Model
{
    protected $table = 'RC_user_bank_accounts';

    protected $fillable = [ 'bank_id', 'account_number', 'account_type', 'user_id' ];
}
