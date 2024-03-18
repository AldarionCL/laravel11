<?php

namespace App\Http\Livewire\Oc;

use App\Models\PurchaseOrder\OcPurchaseOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ReportCPDTable extends DataTableComponent
{
    public ?int $searchFilterDebounce = 500;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setSearchDebounce(1000);
    }

    public function builder(): Builder
    {
        return OcPurchaseOrder::query()
            ->where('car_patent', '<>', null);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->secondaryHeaderFilter('id')
                ->searchable()
                ->sortable(),
            Column::make("Provider", "seller.name")
                ->secondaryHeaderFilter('provider')
                ->searchable()
                ->sortable(),
            Column::make("Car patent", "car_patent")
                ->secondaryHeaderFilter('car_patent')
                ->searchable()
                ->sortable(),
            Column::make('Total', 'total')
                ->searchable()
                ->sortable(),
            Column::make("Created at")
                ->searchable()
                ->format(function ($value) {
                    return Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y");
                })
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('ID', 'id')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'OC_purchase_orders.id', 'like', "%$value%");
                }),
            TextFilter::make('Provider', 'provider')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_providers.name', 'like', "%$value%");
                }),
            TextFilter::make('Car Patent', 'car_patent')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'OC_purchase_orders.car_patent', 'like', "%$value%");
                })
            ];
    }
}
