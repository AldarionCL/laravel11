<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\OrderRequest\Buyer;
use App\Models\OrderRequest\OcQuoteGenerator;
use App\Models\PurchaseOrder\Approver;
use App\Models\PurchaseOrder\OcPurchaseOrderGenerator;
use App\Models\PurchaseOrder\Receptionist;
use App\Models\Roma\BranchOffice;
use App\Models\Roma\Position;
use App\Models\Roma\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = "MA_Usuarios";

    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $connection = 'roma';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ID',
        'Nombre',
        'Email',
        'Clave',
        'TelefonoOficina',
        'Celular',
        'password',
        'PerfilID',
        'CargoID',
        'Activo',
        'Disponible',
        'DetalleID',
        'EventoCreacionID',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sucursales(): BelongsToMany
    {
        return $this->belongsToMany(BranchOffice::class, 'SIS_UsuariosSucursales', 'UsuarioID', 'SucursalID');
    }

    public function position(): HasOne
    {
        return $this->hasOne( Position::class,'ID', 'CargoID' );
    }

    public function profile(): HasOne
    {
        return $this->hasOne( Profile::class,'ID', 'PerfilID');
    }

    public function scopeLocation( $query, $visibility = 0 )
    {
        return $query->with( [ 'sucursales' => function ( $queryBranch ) use ($visibility) {
            return $queryBranch->with( [ 'brand' => function ( $queryBrand ) {
                return $queryBrand->where( 'Activo', 1 )->select( 'ID', 'Gerencia' );
            }])->with( 'typeOfBranches:ID,TipoSucursal', 'business:ID,Empresa' )->where('VisibleOC', '!=', $visibility)->where('Sucursal', 'not like', "%NO USAR%")->where('Activo', 1)->whereNotIn( 'CargoID', [11] )->select( 'MA_Sucursales.ID', 'GerenciaID', 'TipoSucursalID', 'EmpresaID', 'Sucursal' )->orderBy('Sucursal');
        }])->where( 'ID', auth()->user()->ID )->select( 'ID', 'PerfilID', 'CargoID' );
    }

    public function scopeAuthorizationRequestForOrders( $query, $arrayBranch )
    {
        return $query->with( [ 'sucursales' => function ( $queryBranch ) use ( $arrayBranch ) {
            return $queryBranch->where( 'Activo', 1 )->whereIn('TipoSucursalID', $arrayBranch )->whereIn( 'CargoID', [ 2, 4, 5, 6] )->select( 'MA_Sucursales.ID', 'GerenciaID', 'TipoSucursalID', 'EmpresaID', 'Sucursal' );
        }])->where( 'ID', auth()->user()->ID )->select( 'ID', 'PerfilID', 'CargoID' );
    }

    public function buyer(): HasOne
    {
        return $this->hasOne( Buyer::class, 'user_id', 'ID' );
    }

    public function quoteGenerator(): HasOne
    {
        return $this->hasOne( OcQuoteGenerator::class, 'user_id', 'ID');
    }

    public function purchaseOrderGenerator(): HasOne
    {
        return $this->hasOne( OcPurchaseOrderGenerator::class, 'user_id', 'ID');
    }

    public function approver(): HasMany
    {
        return $this->hasMany( Approver::class, 'user_id', 'ID');
    }

    public function receptionist(): HasMany
    {
        return $this->hasMany( Receptionist::class, 'user_id', 'ID');
    }


    public function cargo(): HasOne
    {
        return $this->hasOne( Cargo::class, 'ID', 'CargoID');
    }
}
