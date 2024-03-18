<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\Stock;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class StockTable extends DataTableComponent
{
    protected $model = Stock::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("N° Solicitud", "ocOrderRequest_id")
                ->secondaryHeaderFilter('id')
                ->searchable()
                ->sortable(),
            Column::make("Codigo", "ocProduct.sku")
                ->secondaryHeaderFilter('sku')
                ->searchable()
                ->sortable(),
            Column::make("Articulo", "ocProduct.name")
                ->secondaryHeaderFilter('article')
                ->searchable()
                ->sortable(),
            Column::make("Descripción", "description")
                ->secondaryHeaderFilter('description')
                ->searchable()
                ->sortable(),
            Column::make("Cantidad", "amount")
                ->secondaryHeaderFilter('amount')
                ->searchable()
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return  [
            TextFilter::make('ID', 'id')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar N°',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_stocks.ocOrderRequest_id', 'like', "%$value%");
                }),
            TextFilter::make('SKU', 'sku')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Codigo',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_products.sku', 'like', "%$value%");
                }),
            TextFilter::make('Articulo', 'article')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Articulo',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_oc_products.name', 'like', "%$value%");
                }),
            TextFilter::make('Descripción', 'description')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Articulo',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_stocks.description', 'like', "%$value%");
                }),
            TextFilter::make('Cantidad', 'amount')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Cantidad',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'SP_stocks.amount', 'like', "%$value%");
                })
        ];
    }
}
