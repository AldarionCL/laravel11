<?php

namespace App\Models\Ticket;

use App\Models\Roma\BranchOffice;
use App\Models\Roma\Brand;
use App\Models\Roma\TypeOfBranche;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    protected $table = 'TK_tickets';

    protected $fillable = ['title', 'category', 'subCategory', 'management', 'Identificador', 'zone', 'department', 'applicant', 'assigned', 'detail', 'state', 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'FechaActualizacion', 'EventoActualizacionID', 'UsuarioActualizacionID'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
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
        return $this->hasOne(FileTicket::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo( SubCategory::class, 'subCategory', 'id');
    }

    public function subCategories(): BelongsTo
    {
        return $this->belongsTo( SubCategory::class, 'subCategory', 'id');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo( Category::class, 'category', 'id');
    }
}
