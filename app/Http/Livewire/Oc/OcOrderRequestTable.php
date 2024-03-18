<?php

namespace App\Http\Livewire\Oc;

use App\Http\Utils\Workplace;
use App\Models\OrderRequest\Buyer;
use App\Models\OrderRequest\OcOrderRequest;
use App\Models\Roma\Business;
use App\Models\Roma\TypeOfBranche;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class OcOrderRequestTable extends DataTableComponent
{
    public string $filterLayout = 'slide-down';

    public ?int $searchFilterDebounce = 500;

    protected Workplace $workplace;
    public $branches;
    public bool $status;

    public function __construct($id = null)
    {
        $this->workplace = new Workplace();
        $this->branches = $this->branchOffices(null);
    }

    public function mount()
    {
        $this->status = false;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
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

            if (auth()->user()->approver()->exists()) {
                return OcOrderRequest::whereHas('approvals', function (Builder $query) {
                    $query->where('approver_id', auth()->user()->ID);
                });
            }

            return OcOrderRequest::whereHas('approvals')
                ->where('buyers_id', auth()->user()->ID);

        } elseif ($this->status) {

            if (auth()->user()->approver()->exists()) {
                return OcOrderRequest::whereHas('approvals', function (Builder $query) {
                    $query->where('approver_id', auth()->user()->ID)->where('state', 1);
                });
            }

            return OcOrderRequest::whereHas('approvals')
                ->where('buyers_id', auth()->user()->ID)->where('state', 1);

        }
    }

    public function updatedStatus(): void
    {
        $this->emit('refreshDatatable');
    }

    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('oc.datatable.route-request-order')->with('id', $value)
                )
                ->html(),
            Column::make("Solicitud", "id")
                ->searchable()
                ->sortable(),
            Column::make("Solicitante", "recorder.Nombre")
                ->searchable()
                ->sortable(),
            Column::make("Aprobador", "id")
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.approvalsOr')->with('id',$value)
                )
                ->sortable(),
            Column::make("Empresa", "business.Empresa")
                ->searchable()
                ->sortable(),
            Column::make("Area de Negocios", "typeOfBranch.TipoSucursal")
                ->searchable()
                ->sortable(),
            Column::make("Sección", "section.Seccion")
                ->searchable()
                ->sortable(),
            Column::make("Gerencia", "brand.Gerencia")
                ->searchable()
                ->sortable(),
            Column::make("Sucursal", "branchOffice.Sucursal")
                ->searchable()
                ->sortable(),
            Column::make("Ingreso", "created_at")
                ->searchable()
                ->sortable()
                ->format( fn ( $value ) =>
                     Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y")
                 ),
            Column::make("Estado", "state")
                ->searchable()
                ->sortable()
                ->format(
                    fn( $value, $row, Column $column ) => view('oc.datatable.state')->withState($value)
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
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('business_id', $value);
                }),
            SelectFilter::make('Area de Negocios')
                ->options([
                        '' => 'Todos',
                    ] +
                    TypeOfBranche::query()
                        ->orderBy('TipoSucursal')
                        ->get()
                        ->keyBy('ID')
                        ->map(fn($tag) => $tag->TipoSucursal)
                        ->toArray()
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('typeOfBranch_id', $value);
                }),
            SelectFilter::make('Sección')
                ->options([
                        '' => 'Todos',
                    ] +
                    Section::query()
                        ->orderBy('Seccion')
                        ->get()
                        ->keyBy('ID')
                        ->map(fn($tag) => $tag->Seccion)
                        ->toArray()
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('section_id', $value);
                }),
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
            SelectFilter::make('Estado', 'state')
                ->options([
                    '' => 'Todos',
                    '1' => 'Pendiente de aprobación',
                    '2' => 'Aprobado',
                    '3' => 'Rechazado',
                    '4' => 'En asignación de precio',
                    '5' => 'En orden de compra',
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    if ( $value === '1' ) {
                        $builder->where('state', 1 );
                    } elseif ( $value === '2' ) {
                        $builder->where('state', 2 );
                    } elseif ( $value === '3' ) {
                        $builder->where('state', 3 );
                    }
                    elseif ( $value === '4' ) {
                        $builder->where('state', 4 );
                    }
                    elseif ( $value === '5' ) {
                        $builder->where('state', 5 );
                    }
                }),
            SelectFilter::make('Solicitante')
                ->options(
                    $this->buyers()
                )
                ->filter( function ( Builder $builder, string $value ) {
                    $this->selectBuyers( $builder, $value );
                }),
            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_order_requests.created_at', '>=', $value.' 00:00:01');
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_order_requests.created_at', '<=', $value.' 23:59:59');
                }),
        ];
    }

    public function buyers(): array
    {
        $data = array();

        $buyers = Buyer::with( 'user:ID,Nombre' )->select('user_id' )->get();

        $data[0] = "Todos";

        foreach ($buyers as $item)
        {
            $data[$item->user->ID] = strtoupper( $item->user->Nombre );
        }

        return $data;
    }

    public function selectBuyers( $builder , $value )
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

    public function branchOffices( $brand = null ): array
    {
        $branches = array();

        $location = User::location()->get();

        $branches[0] = "Todos";

        if ($brand !== null) {
            foreach ($location[0]['sucursales'] as $key => $items) {
                if ($items->GerenciaID === intval($brand)) {
                    $branches[$items->ID] = $items->Sucursal;
                }
            }
            return $branches;
        } else {
            foreach ($location[0]['sucursales'] as $key => $items) {
                $branches[$items->ID] = $items->Sucursal;
            }
        }
        return $branches;
    }

    public function selectManagements( $builder, $value )
    {
        return $builder->where( 'MA_Gerencias.ID', '=',  $value);
    }

    public function selectBranches( $builder, $value )
    {
        return $builder->where( 'MA_Sucursales.ID', '=',  $value);
    }

    public function updatedTableFiltersBrands( $value ): void
    {
        $this->branches = branchOfficesFilter( $value );
        $this->filters();
        $this->emit('refreshFilters');
    }
}
