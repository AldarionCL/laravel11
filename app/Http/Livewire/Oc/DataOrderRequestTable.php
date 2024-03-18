<?php

namespace App\Http\Livewire\Oc;

use App\Exports\RequestOrderStatisticsExport;
use App\Http\Utils\Workplace;
use App\Models\OrderRequest\OcDetailOrderRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class DataOrderRequestTable extends DataTableComponent
{
    public string $filterLayout = 'slide-down';

    public ?int $searchFilterDebounce = 500;

    protected Workplace $workplace;
    public $branches;

    public function __construct($id = null)
    {
        $this->workplace = new Workplace();
        $this->branches = $this->branchOffices();
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['SP_oc_order_requests.id as id'])
            ->setDefaultSort('SP_oc_order_requests.id', 'desc')
            ->setTdAttributes(function (Column $column) {
                return [
                    'class' => 'text-xs'
                ];
            });
    }

    public function builder(): Builder
    {
        return OcDetailOrderRequest::query()
            ->with('ocOrderRequest', 'ocProduct')
            /*->leftJoin('ALEXIS_oc_order_requests', 'ALEXIS_oc_detail_order_requests.ocOrderRequest_id', '=', 'ALEXIS_oc_order_requests.id')
            ->leftJoin('ALEXIS_approvals', 'ALEXIS_oc_order_requests.id', '=', 'ALEXIS_approvals.ocOrderRequest_id')
            ->join('MA_Usuarios as Approval', 'ALEXIS_approvals.approver_id', '=', 'Approval.ID')
            ->select('ALEXIS_oc_detail_order_requests.*')*/;
    }

    public function columns(): array
    {
        return [
            Column::make("Número Solicitud", "ocOrderRequest.id")
                ->secondaryHeaderFilter('id')
                ->sortable(),
            Column::make("Estado", "ocOrderRequest.state")
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.state')->withState($value)
                )
                ->sortable(),
            Column::make("Fecha Creación", "created_at")
                ->format(function ($value) {
                    return Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("d-m-Y");
                })
                ->sortable(),
            Column::make("Solicitante", 'ocOrderRequest.recorder.Nombre')
                ->secondaryHeaderFilter('applicant')
                ->sortable(),
            Column::make("Email", "ocOrderRequest.recorder.Email")
                ->sortable(),
            Column::make("Departamento Solicitante", "ocOrderRequest.branchOffice.Sucursal")
                ->secondaryHeaderFilter('branch')
                ->sortable(),
            Column::make("Empresa", "ocOrderRequest.business.Empresa")
                ->secondaryHeaderFilter('bussiness')
                ->sortable(),
            Column::make("Area de Negocio", "ocOrderRequest.typeOfBranch.TipoSucursal")
                ->secondaryHeaderFilter('bussiness')
                ->sortable(),
            Column::make("Sección", "ocOrderRequest.section.Seccion")
                ->secondaryHeaderFilter('bussiness')
                ->sortable(),
            Column::make("Gerencia", "ocOrderRequest.brand.Gerencia")
                ->secondaryHeaderFilter('bussiness')
                ->sortable(),
            Column::make("Sucursal", "ocOrderRequest.branchOffice.Sucursal")
                ->secondaryHeaderFilter('branch')
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
            Column::make("Descripcion", "description")
                ->sortable(),
            Column::make("Cantidad", "amount")
                ->sortable(),
            Column::make("OC", 'ocOrderRequest.id')
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.oc')->with( [ 'id' => $value ] )
                )
                ->sortable(),
            Column::make("N° Factura", 'ocOrderRequest.id')
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.invoices')->with( ['id' => $value ] )
                )
                ->sortable(),
            Column::make("Aprobador", 'ocOrderRequest.id')
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.approvalsOr')->with( ['id' => $value ] )
                )
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
            return Excel::download(new RequestOrderStatisticsExport( $orders ), 'solicitudes.xlsx');
        }

        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'warning',
            'message' => 'Nada seleccionado'
        ]);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Gerencia', 'brands')
                ->options(
                    $this->managements()
                )
                ->filter(function(Builder $builder, string $value) {
                    $this->selectManagements($builder, $value);
                }),
            SelectFilter::make('Sucursal')
                ->options(
                    $this->branches
                )
                ->filter(function(Builder $builder, string $value) {
                    $this->selectBranches($builder, $value);
                }),
            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_order_requests.created_at', '>=', $value.' 00:00:01');
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_order_requests.created_at', '<=', $value.' 23:59:59');
                }),
            SelectFilter::make('Estado')
                ->options([
                    '' => 'Todos',
                    '1' => 'Pendiente de aprobación',
                    '2' => 'Aprobado',
                    '3' => 'Rechazado',
                    /*'4' => 'En asignación de precio',*/
                    '5' => 'En orden de compra',
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    if ( $value === '1' ) {
                        $builder->where('SP_oc_order_requests.state', 1 );
                    } elseif ( $value === '2' ) {
                        $builder->where('SP_oc_order_requests.state', 2 );
                    }elseif ( $value === '3' ) {
                        $builder->where('SP_oc_order_requests.state', 3 );
                    }/*elseif ( $value === '4' ) {
                        $builder->where('ALEXIS_oc_order_requests.state', 4 );
                    }*/elseif ( $value === '5' ) {
                        $builder->where('SP_oc_order_requests.state', 5 );
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
                    $builder->where( 'SP_oc_order_requests.id', 'like', "%$value%");
                }),
            TextFilter::make('Solicitante', 'applicant')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Solicitante',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Usuarios.Nombre', 'like', "%$value%");
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
                    'placeholder' => 'Buscar ID Articulo',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_categories.name', 'like', "%$value%");
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
                })*/
        ];
    }

    public function managements(): array
    {
        $gerencia = $this->workplace->brands();

        $managements = array();
        $managements[0] = "Todos";

        foreach ($gerencia as $management) {
            $managements[$management->ID] = $management->Gerencia;
        }

        return $managements;
    }

    public function branchOffices(): array
    {
        $branches = array();

        $location = User::location()->get();

        $branches[0] = "Todos";

        foreach ($location[0]['sucursales'] as $items)
        {
            $branches[$items->ID] = $items->Sucursal;
        }

        return $branches;

    }

    public function selectManagements( $builder, $value )
    {
        return $value !== '0' ? $builder->where( 'MA_Gerencias.ID', '=',  $value) : $builder->where( 'MA_Gerencias.ID', '>', 0);
    }

    public function selectBranches( $builder, $value )
    {
        return $value !== '0' ? $builder->where( 'MA_Sucursales.ID', '=',  $value) : $builder->where( 'MA_Sucursales.ID', '>', 0);
    }

    public function updatedTableFiltersBrands( $value ): void
    {
        $this->branches = branchOfficesFilter($value);
        $this->filters();
        $this->emit('refreshFilters');
    }
}
