<?php

namespace App\Models\Cash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashDetail extends Model
{
    protected $table = 'RC_cash_details';

    protected $fillable = ['number_document', 'date', 'type_document', 'provider', 'description', 'account_id', 'total', 'cash_id'];

    public function cash(): BelongsTo
    {
        return $this->belongsTo(Cash::class, 'cash_id', 'id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo( FileCash::class, 'id', 'cash_detail_id');
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo( Document::class, 'type_document', 'id');
    }

    public function cashAccount(): BelongsTo
    {
        return $this->belongsTo( CashAccount::class, 'account_id', 'id');
    }
}
