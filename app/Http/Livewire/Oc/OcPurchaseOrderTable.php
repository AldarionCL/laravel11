<?php

namespace App\Http\Livewire\Oc;

use App\Http\Utils\Workplace;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrderGenerator;
use App\Models\Roma\Business;
use App\Models\Roma\TypeOfBranche;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class OcPurchaseOrderTable extends DataTableComponent
{
    // protected $model = OcPurchaseOrder::class;
    public ?int $searchFilterDebounce = 500;

    public string $filterLayout = 'slide-down';

    protected Workplace $workplace;
    public array $branches;
    public bool $status;


    public function __construct($id = null)
    {
        $this->workplace = new Workplace();
        $this->branches = $this->branchOffices();
    }

    public function mount(): void
    {
        if (session()->has('pending')) {
            $this->status = session('pending' );
        }else{
            $this->status = false;
        }

    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('purchase.order.show', $row->id );
            })
            ->setDefaultSort('OC_purchase_orders.id', 'desc')
            ->setConfigurableAreas([
                'toolbar-right-start' => [
                    'cash.datatable.filter', [
                        'status' => $this->status,
                    ]
                ]
            ]);
    }

    public function builder(): Builder
    {

        if ($this->status === false) {
            return OcPurchaseOrder::query()->whereHas('approvals', function (Builder $query) {
                $query->where('approver_id', auth()->user()->ID);
            });
        }elseif($this->status){
            return OcPurchaseOrder::query()->whereHas('approvals', function (Builder $query) {
                $query->where('approver_id', auth()->user()->ID)->where('state', 1);
            })->where('state', 1);
        }
    }

    public function updatedStatus(): void
    {
        if (!session()->has('pending')) {
            session()->put('pending', true);
        }else{
            session()->put('pending', $this->status);
        }

        $this->emit('refreshDatatable');
    }

    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('oc.datatable.route')->with('id', $value)
                )
                ->html(),
            Column::make("N° OC", "id")
                ->searchable()
                ->secondaryHeaderFilter('purchaseorder')
                ->sortable(),
            Column::make("Solicitante", "recorder.Nombre")
                ->searchable()
                ->secondaryHeaderFilter('applicant')
                ->sortable(),
            Column::make("Aprobador", "id")
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.approvals')->with('id',$value)
                )
                ->sortable(),
            Column::make("Empresa", "business.Empresa")
                ->searchable()
                ->sortable(),
            Column::make("Gerencia", "brand.Gerencia")
                ->searchable()
                ->sortable(),
            Column::make("Sucursal", "branchOffice.Sucursal")
                ->searchable()
                ->sortable(),
            Column::make("Ingresado", "created_at")
                ->searchable()
                ->format( function ( $value ) {
                    return Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y");
                } )
                ->sortable(),
            Column::make("Estado", "state")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.state')->withState($value)
                ),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Empresa')
                ->options([
                        '' => 'Todos',
                    ] +
                    Business::query()
                        ->orderBy('Empresa')
                        ->get()
                        ->keyBy('ID')
                        ->map(fn($tag) => $tag->Empresa)
                        ->toArray()
                ),
            SelectFilter::make('Area de Negocio')
                ->options([
                        '' => 'Todos',
                    ] +
                    TypeOfBranche::query()
                        ->orderBy('TipoSucursal')
                        ->get()
                        ->keyBy('ID')
                        ->map(fn($tag) => $tag->TipoSucursal)
                        ->toArray()
                ),
            SelectFilter::make('Gerencia')
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
            SelectFilter::make('Estado')
                ->options([
                    '' => 'Todos',
                    '1' => 'Pendiente de aprobación',
                    '2' => 'Aprobado',
                    '3' => 'Rechazado',
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    if ( $value === '1' ) {
                        $builder->where('state', 1 );
                    } elseif ( $value === '2' ) {
                        $builder->where('state', 2 );
                    } elseif ( $value === '3' ) {
                        $builder->where('state', 3 );
                    }
                }),
            SelectFilter::make('Solicitante')
                ->options(
                    $this->purchaseOrderGenerator()
                )
                ->filter( function ( Builder $builder, string $value ) {
                    $this->selectPurchaseOrderGenerator( $builder, $value );
                }),
            TextFilter::make('OC', 'purchaseorder')
                ->config([
                    'placeholder' => 'N° OC',
                    'maxlength' => '25',
                ])
                ->hiddenFromFilterCount()
                ->hiddenFromMenus()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.id', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Solicitante', 'applicant')
                ->config([
                    'placeholder' => 'Buscar Solicitante',
                    'maxlength' => '25',
                ])
                ->hiddenFromFilterCount()
                ->hiddenFromMenus()
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('MA_Usuarios.ID', 'like', '%'.$value.'%');
                }),
            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.created_at', '>=', $value.' 00:00:01');
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.created_at', '<=', $value.' 23:59:59');
                }),
        ];
    }

    public function purchaseOrderGenerator(): array
    {
        $data = array();

        $generator = OcPurchaseOrderGenerator::with( 'user:ID,Nombre' )->select('user_id' )->get();

        $data[0] = "Todos";

        foreach ($generator as $item)
        {
            $data[ $item->user->ID ] = strtoupper( $item->user->Nombre );
        }

        return $data;
    }

    public function selectPurchaseOrderGenerator( $builder , $value )
    {
        return $builder->where( 'buyers_id', $value );
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

    public function updatedTableFiltersGerencia( $value ): void
    {
        $this->branches = branchOfficesFilter( $value );
        $this->filters();
        $this->emit('refreshFilters');
    }
}
