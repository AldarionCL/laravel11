<?php

namespace App\Models\Kpi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cotizaciones extends Model
{
    use HasFactory;

    protected $table = "VT_Cotizaciones";
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
        'FechaCotizacion',
        'SucursalID',
        'VendedorID',
        'EjecutivoFI',
        'CanalID',
        'ClienteID',
        'OrigenID',
        'SubOrigenID',
        'EstadoID',
        'Patente',
        'MarcaID',
        'ModeloID',
        'VersionID',
        'Color',
        'EstadoVehiculo',
        'Anno',
        'Cantidad',
        'PrecioLista',
        'BonoMarca',
        'BonoFinanciamiento',
        'BonoAdicional',
        'ValorVehiculo',
        'TipoCreditoID',
        'CantidadCuotas',
        'FechaPagare',
        'FechaVencimiento',
        'MetodoPago',
        'Pie',
        'Retoma',
        'TasaInteres',
        'GastosOperacionales',
        'AdicionalesTotal',
        'SimulacionCuotaIDExterno',
        'ValorCuota',
        'Vfmg',
        'Preevaluacion',
        'SeguroDegravamen',
        'SeguroCesantia',
        'Testdrive',
        'Aval',
        'AvalClienteID',
        'ConcatID',
        'Agendado',
        'LeadID',
        'SolicitudCredito',
        'FechaSolicitudCredito',
        'SolCreditoIDExterno',
        'EnviaPDFEmail',
        'EnviaPDFWtsp',
        'FinancieraID',
        'RenovacionID',
        'Venta',
        'Vendido',
        'ForumTanner',
        'CotExterna',
        'VentaID',
        'TieneTasacion',
        'TieneRevision',
        'Llamado',
        'VisibleSegundas',
        'AdicionalesFinanciadosTotal',
        'Contesta',
        'LogTareas',
        'LogSeguimientos',
        'Observaciones',
        'Cantidades',
        'BonoFlotas',
        'DctoVendedor',
        'BonoCliente',
        'BonoMantencionIncluida',
        'concatMG',
        'SolCreditoSegIDExterno',
        'FechaSolicitudCreditoSegundas',
        'FechaCarga',
        'Bandera',
        'IDCarga',
        'ConcatNuevo',
        'VinProb',
    ];



    // SCOPES

    public function scopeFiltrosKPI($query, $unidadNegocio, $gerencia, $sucursal, $vendedor, $marca,  $modelo, $canal, $campoFecha,$fechaInicio,$fechaFin)
    {

        $query = $query->join('MA_Sucursales','VT_Cotizaciones.SucursalID','=','MA_Sucursales.ID')
            ->join('MA_Gerencias','MA_Sucursales.GerenciaID','=','MA_Gerencias.ID')
            ->join('SIS_UsuariosSucursales','SIS_UsuariosSucursales.SucursalID','=','MA_Sucursales.ID');

        if ($unidadNegocio) {
            $query->whereIn('MA_Gerencias.UnidadNegocioID', $unidadNegocio);
        }
        if ($gerencia) {
            $query->whereIn('MA_Sucursales.GerenciaID', $gerencia);
        }
        if ($sucursal) {
            $query->whereIn('SucursalID', $sucursal);
        }
        if ($vendedor) {
            $query->whereIn('VendedorID', $vendedor);
        }
        if ($marca) {
            $query->whereIn('MarcaID', $marca);
        }
        if ($modelo) {
            $query->whereIn('ModeloID', $modelo);
        }
        if ($canal) {
            $query->whereIn('CanalID', $canal);
        }

        if($campoFecha && $fechaInicio && $fechaFin){
            $query->whereBetween($campoFecha,[$fechaInicio,$fechaFin]);
        }


        return $query;
    }

}
