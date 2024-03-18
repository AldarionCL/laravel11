<?php

namespace App\Http\Livewire\Oc;

use App\Models\OrderRequest\OcOrderRequest;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OrderRequestRejected extends DataTableComponent
{
    protected $model = OcOrderRequest::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Business id", "business_id")
                ->sortable(),
            Column::make("Brand id", "brand_id")
                ->sortable(),
            Column::make("Branch id", "branch_id")
                ->sortable(),
            Column::make("TypeOfBranch id", "typeOfBranch_id")
                ->sortable(),
            Column::make("Buyers id", "buyers_id")
                ->sortable(),
            Column::make("State", "state")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
