<?php

namespace App\Models\AccessoryTicket;

use App\Models\Roma\BranchOffice;
use App\Models\Roma\Brand;
use App\Models\Roma\TypeOfBranche;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccessoryTicket extends Model
{
    protected $table = 'TKa_tickets';

    protected $fillable = ['title', 'category', 'subCategory', 'management', 'zone', 'department', 'applicant', 'assigned', 'detail', 'state', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function comments(): HasMany
    {
        return $this->hasMany(AccessoryComment::class, 'id', 'ticket_id');
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applicant', 'ID');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned', 'ID');
    }

    public function gerencia(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'management', 'ID');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(BranchOffice::class, 'department', 'ID');
    }

    public function typeOfBranch(): BelongsTo
    {
        return $this->belongsTo( TypeOfBranche::class, 'zone', 'ID');
    }

    public function file(): HasOne
    {
        return $this->hasOne(AccessoryFileTicket::class, 'ticket_id', 'id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo( AccessorySubCategory::class, 'subCategory', 'id');
    }

    public function subCategories(): BelongsTo
    {
        return $this->belongsTo( AccessorySubCategory::class, 'subCategory', 'id');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo( AccessoryCategory::class, 'category', 'id');
    }
}
