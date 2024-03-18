<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\Provider;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ProvidersTable extends DataTableComponent
{
    protected $model = Provider::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('name', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('oc.datatable.providers')->with('id', $value)
                )
                ->html(),
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->secondaryHeaderFilter('provider')
                ->sortable(),
            Column::make("RUT", "rut")
                ->secondaryHeaderFilter('rut')
                ->sortable(),
            Column::make("Condiciones de Pago", "payment_condition")
                ->sortable(),
            Column::make("Contacto", "contact")
                ->secondaryHeaderFilter('contact')
                ->sortable(),
            Column::make("Dirección", "address")
                ->secondaryHeaderFilter('direction')
                ->sortable(),
            Column::make("Fono", "phone")
                ->sortable(),
            Column::make("Email", "email")
                ->secondaryHeaderFilter('email')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Proveedor', 'provider')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Proveedor',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_providers.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('RUT', 'rut')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar RUT',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_providers.rut', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Contacto', 'contact')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Contacto',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_providers.contact', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Direccion', 'direction')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Dirección',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_providers.address', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Email', 'email')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Email',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('SP_providers.email', 'like', '%'.$value.'%');
                }),
        ];
    }
}
