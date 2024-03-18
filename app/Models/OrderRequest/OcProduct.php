<?php

namespace App\Models\OrderRequest;

use App\Models\PurchaseOrder\Account;
use App\Models\PurchaseOrder\AccountingBudget;
use App\Models\Roma\BranchOffice;
use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OcProduct extends Model
{
    use HasSku;

    protected $table = 'SP_oc_products';
    protected $connection = 'mysql';


    protected $fillable = [ 'name', 'sku', 'ocSubCategory_id', 'costCenter_id', 'currency_id', 'active', 'measure_id', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID' ];

    public function ocSubCategory(): BelongsTo
    {
        return $this->belongsTo(OcSubCategory::class, 'ocSubCategory_id', 'id');
    }

    public function costCenter(): BelongsTo
    {
        return $this->belongsTo( BranchOffice::class, 'costCenter_id', 'ID');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo( Currency::class, 'currency_id', 'id');
    }

    public function measure(): BelongsTo
    {
        return $this->belongsTo( Measure::class, 'measure_id', 'id');
    }

    public function accountingBudget(): HasOne
    {
        return $this->hasOne( AccountingBudget::class, 'AccountID', 'AccountID' );
    }

    public function account(): HasOne
    {
        return $this->hasOne( Account::class, 'ID', 'AccountID');
    }
}
