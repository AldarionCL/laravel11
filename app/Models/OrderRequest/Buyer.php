<?php

namespace App\Models\OrderRequest;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buyer extends Model
{
    protected $table = 'SP_buyers';
    protected $connection = 'mysql';


    protected $fillable = [ 'branchOffice_id', 'user_id' ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'ID');
    }
}
