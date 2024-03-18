<?php

namespace App\Models\Roma;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserBranch extends Pivot
{
    protected $table = 'SIS_UsuariosSucursales';
    protected $connection = 'roma';

    protected $primaryKey = 'ID';

    protected $fillable = [ 'FechaCreacion', 'EventoCreacionID', 'UsuarioCreacionID', 'SucursalID', 'UsuarioID', 'DisponibleLead', 'CargoID'];

//    protected $connection = 'roma';

    public function scopeUsers( $query, $branchId )
    {
        return $query->where('SucursalID', $branchId )->whereIn( 'CargoID', [ 2, 4, 5, 6 ] )->select( 'SucursalID', 'UsuarioID', 'CargoID' );
    }
}
