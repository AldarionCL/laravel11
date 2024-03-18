<?php

namespace App\Http\Livewire\Oc;

use App\Http\Utils\Workplace;
use App\Models\PurchaseOrder\OcDetailPurchaseOrder;
use App\Models\PurchaseOrder\OcPurchaseOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class OcPurchaseOrderApprovedTable extends DataTableComponent
{
    // protected $model = OcPurchaseOrder::class;

    public ?int $searchFilterDebounce = 500;

    public string $filterLayout = 'slide-down';

    protected Workplace $workplace;
    public array $branches;

    public function __construct($id = null)
    {
        $this->workplace = new Workplace();
        $this->branches = $this->branchOffices();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('OC_purchase_orders.id', 'desc');
    }

    public function builder(): Builder
    {
       return OcPurchaseOrder::query()
           ->whereHas('receptionist', function ( $query ) {
               $query->where( 'user_id', auth()->user()->ID );
           })
           ->where( 'state', 2 );
    }

    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('oc.datatable.reception-oc-controller')->with('id', $value)
                )
                ->html(),
            Column::make("ID", "id")
                ->secondaryHeaderFilter('id')
                ->sortable(),
            Column::make("Solicitante", "recorder.Nombre")
                ->sortable(),
            Column::make("Gerencia", "brand.Gerencia")
                ->searchable()
                ->sortable(),
            Column::make("C. Costo", "branchOffice.Sucursal")
                ->sortable(),
            Column::make("Proveedor", "seller.name")
                ->sortable(),
            Column::make("Monto Neto", "id")
                ->format( fn( $value ) => number_format(OcDetailPurchaseOrder::where('ocPurchaseOrder_id', $value )->sum('totalPrice'), 0, ',', '.')  )
                ->sortable(),
            Column::make("Solicitante", "recorder.Nombre")
                ->sortable(),
            Column::make("Ingresado", "created_at")
                ->searchable()
                ->format( function ( $value ) {
                    return Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y");
                } )
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('ID', 'id')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar N°',
                    'maxlength' => 25
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.id', 'like', "%$value%");
                }),

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
            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.created_at', '>=', $value.' 00:00:01' );
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('OC_purchase_orders.created_at', '<=', $value.' 23:59:59');
                }),
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

    public function updatedTableFiltersGerencia( $value ): void
    {
        $this->branches = branchOfficesFilter( $value );
        $this->filters();
        $this->emit('refreshFilters');
    }
}
