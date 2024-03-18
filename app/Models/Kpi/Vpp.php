<?php

namespace App\Models\Kpi;

use App\Models\Clientes;
use App\Models\dyp\Marca;
use App\Models\dyp\Modelos;
use App\Models\dyp\Vehiculos;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vpp extends Model
{
    use HasFactory;

    protected $table = "VT_Vpp";
    protected $connection = 'roma';

    protected $primaryKey = "ID";
    protected $fillable = [
        'ID',
        'FechaCreacion',
        'UsuarioCreacionID',
        'FechaActualizacion',
        'UsuarioActualizacionID',
        'EntidadFinancieraTxt',
        'MontoPrenda',
        'estado_solicitud_prepago',
        'FechaVencimiento',
        'PagaPrenda',
        'MarcaOld',
        'ModeloOld',
        'cliente_nombre_prepago',
        'la',
        'fecha_pagare',
        'cliente_rut_prepago',
        'prepago_cargado',
        'TomadorTxt',
        'fecha_comprobante_prepago_cancelado',
        'lb_anterior',
        'cliente_prepago',
        'rut_prepago',
        'saldo_prepago',
        'tipo_pago_prepago',
        'enviado_prepago',
        'estado_prepago',
        'monto_prepago_confirmado',
        'Trazabilidad_EstadoAlzamiento',
        'Trazabilidad_EtapaTransferencia',
        'EtapaTxt',
        'Patente',
        'VentaID',
        'TienePrenda',
        'PrepagoID',
        'VehiculoID',
        'SucursalTomaID',
        'ClienteID',
        'MarcaID',
        'ModeloID',
        'ModeloTxt',
        'PrecioCompra',
        'OrigenID',
        'SubOrigenID',
        'TomadorID',
        'UbicacionRecepcionVPP',
        'Anio',
        'Kilometraje',
        'Comentario',
        'EstadoID',
        'Activo',
    ];

    public function Venta()
    {
        return $this->hasOne(Ventas::class, 'ID', 'VentaID');
    }
    public function Vehiculo()
    {
        return $this->hasOne(Vehiculos::class, 'ID', 'VehiculoID');
    }
    public function Sucursal()
    {
        return $this->hasOne(Sucursales::class, 'ID', 'SucursalTomaID');
    }
    public function Cliente()
    {
        return $this->hasOne(Clientes::class, 'ID', 'ClienteID');
    }
    public function Marca()
    {
        return $this->hasOne(Marca::class, 'ID', 'MarcaID');
    }
    public function Modelo()
    {
        return $this->hasOne(Modelos::class, 'ID', 'ModeloID');
    }
    public function Tomador()
    {
        return $this->hasOne(User::class, 'ID', 'TomadorID');
    }

}
