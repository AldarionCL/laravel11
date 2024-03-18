<?php

namespace App\Models\Kpi;

use App\Models\Clientes;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\dyp\Versiones;
use App\Models\Sucursales;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ventas extends Model
{
    use HasFactory;

    protected $table = "VT_Ventas";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'FechaCreacion',
        'EventoCreacionID',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'EventoActualizacionID',
        'UsuarioActualizacionID',
        'FechaVenta',
        'CotizacionID',
        'SinCotizacion',
        'SucursalID',
        'VendedorID',
        'JefeSucursalID',
        'CanalID',
        'ClienteID',
        'VehiculoID',
        'Cajon',
        'MarcaID',
        'ModeloID',
        'VersionID',
        'CompraPara',
        'ClienteParaID',
        'NotaVenta',
        'EstadoVentaID',
        'TipoVentaID',
        'EntidadFinancieraID',
        'NumeroContrato',
        'AgendaPrimeraMantencion',
        'FechaEstimadaEntrega',
        'Comentario',
        'PrecioCompra',
        'PrecioLista',
        'BonoFinanciamiento',
        'BonoMarca',
        'BonoAdicional',
        'BonoFlotas',
        'BonoMantencionIncluida',
        'BonoOtros',
        'Combustible',
        'Logistica',
        'PreparacionUsados',
        'Multas',
        'GarantiaUsados',
        'SetYPisos',
        'DescuentoVendedor',
        'PreparacionPreEntrega',
        'AccesoriosVentaPompeyo',
        'AccesoriosCostoPompeyo',
        'AccesoriosCostoCliente',
        'AccesoriosVentaCliente',
        'TramiteCostoPompeyo',
        'TramiteVentaPompeyo',
        'TramiteCostoCliente',
        'TramiteVentaCliente',
        'GastosDirectosVehiculo',
        'UtilidadComercial',
        'ElementosFinanciables',
        'AccesoriosFinanciados',
        'TramitesFinanciados',
        'TipoMantencionID',
        'TieneSeguro',
        'SeguroID',
        'Patente',
        'FechaFactura',
        'NumeroFactura',
        'ValorFactura',
        'TransferenciaOtroConsecionario',
        'TipoCupon',
        'ColorReferencial',
        'CreditoInstantaneo',
        'CreditoFirmado',
        'CantidadCuota',
        'TasaInteres',
        'ComisionAcepNeta',
        'TipoCredito',
        'ValorCuota',
        'Pie',
        'Colocacion',
        'SaldoFinanciar',
        'SolicitarInscripcion',
        'TieneVPP',
        'EstadoActaEntregaID',
        'FechaActaEntrega',
        'EstadoFI',
        'MantencionVentaCliente',
        'MantencionesFinanciados',
        'TieneRevision',
        'TieneTasacion',
        'TieneAccesorio',
        'BancoID',
        'AseguradoraID',
        'Vin',
        'ColorID',
        'Deducible',
        'NumeroPoliza',
        'FormaPago',
        'MontoPrima',
        'SaldoCreditoPompeyo',
        'ModeloTxt',
        'TramiteNoFinanciado',
        'AccesorioNoFinanciado',
        'UsuarioFI',
        'AccesoriosInstalados',
        'BonoCliente',
        'BonoMarca2',
        'BonoFinanciamientoAdicional',
        'Provision_ComisionAcepNeta',
        'ComisionAcepNeta_Cancelado',
        'Provision_BonoCliente',
        'BonoCliente_Cancelado',
        'Provision_BonoMarca',
        'BonoMarca_Cancelado',
        'Provision_BonoFinanciamiento',
        'BonoFinanciamiento_Cancelado',
        'Provision_BonoFinanciamientoAdicional',
        'BonoFinanciamientoAdicional_Cancelado',
        'Provision_BonoFlotas',
        'BonoFlotas_Cancelado',
        'Provision_BonoMantencionIncluida',
        'BonoMantencionIncluida_Cancelado',
        'Tmp_ComisionAcepNeta_Cancelado',
        'Tmp_BonoCliente_Cancelado',
        'Tmp_BonoMarca_Cancelado',
        'Tmp_BonoFinanciamiento_Cancelado',
        'Tmp_BonoFlotas_Cancelado',
        'Tmp_BonoMantencionIncluida_Cancelado',
        'Tmp_BonoFinanciamientoAdicional_Cancelado',
        'TieneArchivoReserva',
        'Borrar',
        'ComisionUtilidadVend',
        'ComisionCreditosVend',
        'ComisionSegurosVend',
        'ComPorcVtas',
        'ComPorcCreditos',
        'ComPorcSeguros',
    ];


    public function Sucursal()
    {
        return $this->hasOne(Sucursales::class, 'ID', 'SucursalID');
    }
    public function Vendedor()
    {
        return $this->hasOne(User::class, 'ID', 'VendedorID');
    }
    public function JefeSucursal()
    {
        return $this->hasOne(User::class, 'ID', 'JefeSucursalID');
    }
    public function Canal()
    {
        return $this->hasOne(Canales::class, 'ID', 'CanalID');
    }
    public function Cliente()
    {
        return $this->hasOne(Clientes::class, 'ID', 'ClienteID');
    }
    public function Vehiculo()
    {
        return $this->hasOne(Vehiculos::class, 'ID', 'VehiculoID');
    }
    public function Marca()
    {
        return $this->hasOne(Marca::class, 'ID', 'MarcaID');
    }
    public function Modelo()
    {
        return $this->hasOne(Modelos::class, 'ID', 'ModeloID');
    }
    public function Version()
    {
        return $this->hasOne(Versiones::class, 'ID', 'VersionID');
    }


    // SCOPES

    public function scopeFiltrosKPI($query, $filtros)
    {

        $query = $query->join('MA_Sucursales','VT_Ventas.SucursalID','=','MA_Sucursales.ID')
        ->join('MA_Gerencias','MA_Sucursales.GerenciaID','=','MA_Gerencias.ID')
        ->join('SIS_UsuariosSucursales','SIS_UsuariosSucursales.SucursalID','=','MA_Sucursales.ID');

        if (isset($filtros["unidadNegocio"])) {
            $query->whereIn('MA_Gerencias.UnidadNegocioID', $filtros["unidadNegocio"]);
        }
        if (isset($filtros["gerencia"])) {
            $query->whereIn('MA_Sucursales.GerenciaID', $filtros["gerencia"]);
        }
        if (isset($filtros["sucursal"])) {
            $query->whereIn('SucursalID', $filtros["sucursal"]);
        }
        if (isset($filtros["vendedor"])) {
            $query->whereIn('VendedorID', $filtros["vendedor"]);
        }
        if (isset($filtros["marca"])) {
            $query->whereIn('MarcaID', $filtros["marca"]);
        }
        if (isset($filtros["tipoventa"])) {
            $query->whereIn('TipoVentaID', $filtros["tipoventa"]);
        }
        if (isset($filtros["modelo"])) {
            $query->whereIn('ModeloID', $filtros["modelo"]);
        }
        if (isset($filtros["canal"])) {
            $query->whereIn('CanalID', $filtros["canal"]);
        }
        if (isset($filtros["cierre"])) {
            $query->whereIn('EstadoVentaID', $filtros["cierre"]);
        }
        if (isset($filtros["cupon"])) {
            $query->whereIn('TipoCupon', $filtros["cupon"]);
        }
        if((isset($filtros["oficina"]) && $filtros["oficina"] == 1) && (isset($filtros["sucursal"]) && $filtros["sucursal"] == null)) {
            $query->whereNotLike('MA_Sucursales.Sucursal', "%OFICINA%");
        }

        if(isset($filtros["campoFecha"]) && isset($filtros["searchFechaInicio"]) && isset($filtros["searchFechaFin"])){
            $query->whereBetween($filtros["campoFecha"],[date('Y-m-d H:i',strtotime($filtros["searchFechaInicio"])),date('Y-m-d H:i',strtotime($filtros["searchFechaFin"]))]);
        }


        return $query;
    }


}
