<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcProduct;
use App\Models\OrderRequest\OcSubCategory;
use App\Models\Roma\BranchOffice;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ProductListTable extends DataTableComponent
{
    protected $model = OcProduct::class;

    public string $filterLayout = 'slide-down';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPaginationVisibilityEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Producto", "name")
                ->secondaryHeaderFilter('product')
                ->sortable(),
            Column::make("Sku", "sku")
                ->secondaryHeaderFilter('sku')
                ->sortable(),
            Column::make("Sub Categoria", "ocSubCategory.name")
                ->secondaryHeaderFilter('subCategory')
                ->sortable(),
            Column::make("Centro de Costo", "costCenter.Sucursal")
                ->sortable(),
            Column::make("Moneda", "currency.name")
                ->sortable(),
            Column::make("Medida", "measure.name")
                ->sortable(),
            Column::make("Editar", "id")
                ->format(
                    fn($value, $row, Column $column) => view('oc.datatable.edit-product')->with( 'ocProduct', $row )
                ),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Sub Categories')
                ->options(
                    $this->subCategories()
                )
                ->filter(function(Builder $builder, string $value) {
                    $this->selectSubCategories($builder, $value);
                }),
            SelectFilter::make('Centro de Costo')
                ->options(
                    $this->costCenter()
                )
                ->filter(function(Builder $builder, string $value) {
                    $this->selectCostCenter($builder, $value);
                }),
            TextFilter::make('Producto', 'product')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Producto',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_products.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Sku', 'sku')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar SKU',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_products.sku', 'like', '%'.$value.'%');
                }),
            TextFilter::make('SubCategoria', 'subCategory')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Sub Categoria',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_oc_sub_categories.name', 'like', '%'.$value.'%');
                }),
        ];
    }

    public function products(): array
    {

        $data = OcProduct::select('id', 'name')->get();

        $products = array();

        $products[0] = "Todos";

        foreach ($data as $item) {
            $products[$item->id] = strtoupper( $item->name );
        }

        return $products;
    }

    public function selectProducts( $builder, $value )
    {
        return $builder->where( 'SP_oc_products.id', '=',  $value);
    }

    public function subCategories(): array
    {

        $data = OcSubCategory::select('id', 'name')->get();

        $subCategories = array();

        $subCategories[0] = "Todos";

        foreach ($data as $item) {
            $subCategories[$item->id] = strtoupper( $item->name );
        }

        return $subCategories;
    }

    public function selectSubCategories( $builder, $value )
    {
        return $builder->where( 'SP_oc_sub_categories.id', '=',  $value);
    }

    public function costCenter(): array
    {

        $data = BranchOffice::select('ID', 'Sucursal')->orderBy('Sucursal', 'asc')->get();

        $branchOffices = array();

        $branchOffices[0] = "Todos";

        foreach ($data as $item) {
            $branchOffices[$item->ID] = strtoupper( $item->Sucursal );
        }

        return $branchOffices;
    }

    public function selectCostCenter( $builder, $value )
    {
        return $builder->where( 'MA_Sucursales.ID', '=',  $value);
    }

}
