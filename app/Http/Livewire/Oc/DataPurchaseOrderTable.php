<?php

namespace App\Http\Livewire\Oc;

use App\Exports\PurchaseOrderStatisticsExport;
use App\Models\OrderRequest\DetailReception;
use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class DataPurchaseOrderTable extends DataTableComponent
{
    public string $filterLayout = 'slide-down';

    public ?int $searchFilterDebounce = 500;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['OC_purchase_orders.id as id'])
            ->setDefaultSort('OC_purchase_orders.id', 'desc')
            ->setTdAttributes(function (Column $column) {
                return [
                    'class' => 'text-xs'
                ];
            });
    }

    public function builder(): Builder
    {
        return OcDetailPurchaseOrder::query()
            ->with('ocPurchaseOrder.recorder', 'ocPurchaseOrder.approvals', 'ocProduct.ocSubCategory.ocCategory', 'ocPurchaseOrder.receptions.fileReception' )
            ->leftJoin('MA_Sucursales as Branch', 'OC_detail_purchase_orders.branch_id', '=', 'Branch.ID')
            ->leftJoin('MA_Gerencias as Brand', 'Branch.GerenciaID', '=', 'Brand.ID')
            ->leftJoin('OC_purchase_orders', 'OC_detail_purchase_orders.ocPurchaseOrder_id', '=', 'OC_purchase_orders.id')
            ->leftJoin('OC_approvals', 'OC_purchase_orders.id', '=', 'OC_approvals.ocOrderRequest_id')
            ->join('MA_Usuarios as Approval', 'OC_approvals.approver_id', '=', 'Approval.ID')
            ->select('OC_detail_purchase_orders.*', 'Branch.Sucursal as centerCost', 'Brand.Gerencia as brandCostCenter')
            ->distinct();
    }

    public function columns(): array
    {
        return [

            LinkColumn::make('Número OC')
                ->secondaryHeaderFilter('id')
                ->title(fn($row) => $row->{"ocPurchaseOrder.id"} )
                ->location(fn($row) => $row->{"ocPurchaseOrder.state"} === 2 ? route('create.pdf', $row->{"ocPurchaseOrder.id"}) : "#" )
            ,
            Column::make("Detalle ID", "id")
                ->sortable(),
            Column::make("Empresa", "ocPurchaseOrder.business.Empresa")
                ->secondaryHeaderFilter('bussinessOc')
                ->sortable(),
            Column::make("Estado", "ocPurchaseOrder.state")
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.state')->withState($value)
                )
                ->sortable(),
            Column::make("Fecha Creación", "created_at")
                ->format(function ($value) {
                    return Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("d-m-Y");
                })
                ->sortable(),
            Column::make("Solicitante", "ocPurchaseOrder.recorder.Nombre")
                ->secondaryHeaderFilter('recoder')
                ->sortable(),
            Column::make("Email", "ocPurchaseOrder.recorder.Email")
                ->sortable(),
            Column::make("Departamento Solicitante", "ocPurchaseOrder.branchOffice.Sucursal")
                ->secondaryHeaderFilter('branchOffice')
                ->sortable(),
            Column::make("Gerencia", "ocPurchaseOrder.brand.Gerencia")
                ->secondaryHeaderFilter('bussiness')
                ->sortable(),

            Column::make("Sucursal", "ocPurchaseOrder.branchOffice.Sucursal")
                ->secondaryHeaderFilter('branch')
                ->sortable(),
            Column::make("Gerencia C. Costo")
                ->label( fn($row) => $row->brandCostCenter)
                ->secondaryHeaderFilter('bussinessCostCenter')
                ->sortable(),
            Column::make("C. Costo" )
                ->label( fn($row) => $row->centerCost)
                ->secondaryHeaderFilter('center')
                ->sortable(),
            Column::make("ID Articulo", "ocProduct.sku")
                ->secondaryHeaderFilter('sku')
                ->sortable(),
            Column::make("Articulo", "ocProduct.name")
                ->secondaryHeaderFilter('article')
                ->sortable(),
            Column::make("Categoria", "ocProduct.ocSubCategory.ocCategory.name")
                ->secondaryHeaderFilter('category')
                ->sortable(),
            Column::make("Sub Categoria", "ocProduct.ocSubCategory.name")
                ->secondaryHeaderFilter('subCategory')
                ->sortable(),
            Column::make("Descripcion", "description")
                ->sortable(),
            Column::make("Cantidad", "amount")
                ->sortable(),

            Column::make("Unitario", "unitPrice")
                ->format( function ( $value ) {
                    return number_format( $value , 0, '', '.');
                } )
                ->sortable(),
            Column::make("Total Neto", "totalPrice")
                ->format( function ( $value ) {
                    return number_format( $value , 0, '', '.');
                } )
                ->sortable(),
            Column::make("Impuesto", 'tax.name')
                /*->label( function () {
                    return "IVA";
                })*/
                ->sortable(),
            Column::make("Valor Impuesto", "taxAmount")
                /*->format(  function ( $value ){
                    return number_format(  round( $value * 0.19 ) , 0, '', '.');
                })*/
                ->format( function ( $value ) {
                    return number_format( $value , 0, '', '.');
                } )
                ->sortable(),
            Column::make("Total")
                ->label( fn($row) => number_format(  round( $row->totalPrice + $row->taxAmount ) , 0, '', '.') )
                /*->format(  function ( $value ){
                    return number_format(  round( $value + ( $value * 0.19 ) ) , 0, '', '.');
                })*/
                ->sortable(),
            Column::make("Proveedor", "ocPurchaseOrder.seller.name")
                ->secondaryHeaderFilter('provider')
                ->sortable(),
            Column::make("RUT Proveedor", "ocPurchaseOrder.seller.rut")
                ->secondaryHeaderFilter('rut')
                ->sortable(),
            Column::make("N° Factura", "ocPurchaseOrder.id")
                ->format( fn( $value ) => view('oc.datatable.invoice')->with( [ 'id' => $value ]) )
                ->sortable(),
            Column::make("Fecha Factura", "ocPurchaseOrder.receptions.created_at")
                ->format(function ($value) {
                    return $value ? Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("d-m-Y") : "";
                })
                ->sortable(),
            Column::make("Recepción", "id")
                ->label( function ($value) {
                    return DetailReception::where('ocDetailOrderRequest', $value->id)->count('received') > 0 ? "SI" : "NO";
                })
                ->sortable(),
            Column::make("Cuenta Contable", "ocProduct.account.Account")
                ->sortable(),
            Column::make("Aprobador", 'ocPurchaseOrder.id')
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.approvals')->with( ['id' => $value ] )
                )
                ->sortable(),
            Column::make("Comentario", "ocPurchaseOrder.comment")
                ->sortable(),
        ];
    }

    public array $bulkActions = [
        'exportSelection' => 'Exportar',
    ];

    public function exportSelection() {
        if ($this->getSelectedCount() > 0) {
            $orders = $this->getSelected();
            $this->clearSelected();
            return Excel::download(new PurchaseOrderStatisticsExport( $orders ), 'data-orden-de-compras.xlsx');
        }

        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'warning',
            'message' => 'Nada seleccionado'
        ]);
    }

    public function filters(): array
    {
        return [

            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.created_at', '>=', $value.' 23:59:59');
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.created_at', '<=', $value.' 23:59:59');
                }),
            SelectFilter::make('Estado')
                ->options([
                    '' => 'Todos',
                    '1' => 'Pendiente de aprobación',
                    '2' => 'Aprobado',
                    '3' => 'Rechazado',
                    /*'4' => 'En asignación de precio',
                    '5' => 'En orden de compra',*/
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    if ( $value === '1' ) {
                        $builder->where('OC_purchase_orders.state', 1 );
                    } elseif ( $value === '2' ) {
                        $builder->where('OC_purchase_orders.state', 2 );
                    }elseif ( $value === '3' ) {
                        $builder->where('OC_purchase_orders.state', 3 );
                    }elseif ( $value === '4' ) {
                        $builder->where('OC_purchase_orders.state', 4 );
                    }elseif ( $value === '5' ) {
                        $builder->where('OC_purchase_orders.state', 5 );
                    }
                }),
            TextFilter::make('ID', 'id')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar N°',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'OC_purchase_orders.id', 'like', "%$value%");
                }),
            TextFilter::make('Sucursal', 'branchOffice')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Depto. Solicitante',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Sucursales.Sucursal', 'like', "%$value%");
                }),
            TextFilter::make('Sucursal', 'branch')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Sucursal',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Sucursales.Sucursal', 'like', "%$value%");
                }),
            TextFilter::make('Sucursal', 'center')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar C. Costo',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'Branch.Sucursal', 'like', "%$value%");
                }),
            TextFilter::make('Solicitante', 'recoder')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Solicitante',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Usuarios.Nombre', 'like', "%$value%");
                }),
            /*TextFilter::make('Aprobador', 'approval')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Aprobador',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'Approval.Nombre', 'like', "%$value%");
                }),*/
            TextFilter::make('Gerencia', 'bussiness')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Gerencia',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Gerencias.Gerencia', 'like', "%$value%");
                }),
            TextFilter::make('Gerencia', 'bussinessCostCenter')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Gerencia',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'Brand.Gerencia', 'like', "%$value%");
                }),
            TextFilter::make('Empresa', 'bussinessOc')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Empresa',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_PompeyoEmpresas.Empresa', 'like', "%$value%");
                }),
            TextFilter::make('SKU', 'sku')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar ID Articulo',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_products.sku', 'like', "%$value%");
                }),
            TextFilter::make('Articulos', 'article')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Articulo',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_products.name', 'like', "%$value%");
                }),
            TextFilter::make('Categoria', 'category')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Categoria',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_categories.name', 'like', "%$value%");
                }),
            TextFilter::make('Sub ategoria', 'subCategory')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Sub Categoria',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_sub_categories.name', 'like', "%$value%");
                }),
            TextFilter::make('Proveedor', 'provider')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Proveedor',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_providers.name', 'like', "%$value%");
                }),
            TextFilter::make('RUT', 'rut')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Proveedor',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_providers.rut', 'like', "%$value%");
                }),
        ];
    }
}
