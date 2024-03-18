<?php

namespace App\Models\Roma;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BranchOffice extends Model
{
    protected $table = 'MA_Sucursales';

    protected $fillable = ['ID', 'Sucursal', 'GerenciaID', 'EmpresaID', 'ComunaID'];

    protected $primaryKey = 'ID';

//    protected $connection = 'roma';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'SIS_UsuariosSucursales', 'SucursalID', 'UsuarioID');
    }

    public function typeOfBranches(): HasMany
    {
        return $this->hasMany( TypeOfBranche::class, 'ID', 'TipoSucursalID' );
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'GerenciaID', 'ID');
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo( Business::class, 'EmpresaID', 'ID');
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo( Commune::class, 'ComunaID', 'ID');
    }
}
