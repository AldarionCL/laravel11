<?php

namespace App\Http\Livewire\Landbot;

use Carbon\Carbon;
use App\Models\Landbot\Chat;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LeadUsedTable extends DataTableComponent
{
//    protected $model = ChatUsed::class;

    public function builder(): Builder
    {
        return Chat::query()
            ->where('seller_id', auth()->user()->ID )->where('attention', 'Usados')->orderBy('id', 'DESC');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('livewire.landbot.table-search')->with('id', $value)
                ),
            Column::make("Id", "id")
                ->searchable()
                ->sortable(),
            Column::make("Nombre", "name_customer")
                ->searchable()
                ->sortable(),
            Column::make("Atencion", "attention")
                ->searchable()
                ->sortable(),
            Column::make("Marca - Gerencia", "brand")
                ->searchable()
                ->sortable(),
            Column::make("Modelo", "model")
                ->searchable()
                ->sortable(),
            Column::make("Fono", "phone")
                ->searchable()
                ->sortable(),
            Column::make("Ingresado", "created_at")
                ->searchable()
                ->format( fn( $value ) => Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y"))
                ->sortable(),
        ];
    }
}
