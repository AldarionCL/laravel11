<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $table = 'MA_Gerencias';

    protected $primaryKey = 'ID';

    protected $fillable = ['ID'];

    public function branchOffices(): HasMany
    {
        return $this->hasMany( BranchOffice::class, 'ID', 'GerenciaID');
    }
}
