<?php

namespace App\Http\Livewire\Customer;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;

class CustomerTable extends DataTableComponent
{
    protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('ID');
    }

    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('customer.datatable.route')->with('id', $value)
                )
                ->html(),
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('customer.datatable.edit')->with('id', $value)
                )
                ->html(),
            Column::make("ID", "ID")
                ->sortable(),
            Column::make("Nombre", "Nombre")
                ->sortable(),
            Column::make("Rut", "Rut")
                ->sortable(),
            Column::make("Email", "Email")
                ->sortable(),
            Column::make("Telefono", "Telefono")
                ->sortable(),
            Column::make("FechaNacimiento", "FechaNacimiento")
                ->sortable(),
            Column::make("Direccion", "Direccion")
                ->sortable(),
            Column::make("ComunaID", "ComunaID")
                ->sortable(),
            Column::make("RegionID", "RegionID")
                ->sortable(),
            Column::make("EstadoCivilID", "EstadoCivilID")
                ->sortable(),
            Column::make("ProfesionID", "ProfesionID")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
        ];
    }
}
