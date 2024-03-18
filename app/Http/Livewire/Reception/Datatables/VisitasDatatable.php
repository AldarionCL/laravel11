<?php
namespace App\Http\Livewire\Reception\Datatables;

use App\Models\reception\Visitas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Provider;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class VisitasDatatable extends DataTableComponent
{
    protected $model = Visitas::class;
    public $params;
    public $listeners = ['updateDatatableVisita'];


    public function updateDatatableVisita(): void
    {
       $this->emit("refreshLivewireDatatable");
    }
    public function configure(): void
    {
        $this->setPrimaryKey('MA_Visitas.ID')
            ->setDefaultSort('MA_Visitas.FechaCreacion', 'desc')
            ->setColumnSelectDisabled()->setColumnSelectHiddenOnTablet();
        $this->setSelectAllDisabled();
        $this->setTableAttributes([
            'id' => 'list_dyp',
            'class' => 'text-xs table-responsive',
        ]);
        $this->setTbodyAttributes([
            'default' => true,
            'class' => 'text-xs',
        ]);
    }
    public function builder(): Builder
    {
        $datos = Visitas::query()->selectRaw(
            "ID,
             Nombres ,
            Apellidos ,
            Email ,
            Telefono ,
            Direccion ,
            FechaCreacion,
            Rut,
            Patente"
        );
        if($this->params)
            $datos->where('FechaCreacion','>=',date('Y-m-d 00:00:01'));

        return $datos;
    }

    public function columns(): array
    {
        return [
            Column::make('Marcar Salida','Fecha_salida')
                ->format(function ($value, $column, $row) {
                    return view('livewire.reception.datatables.table-actions', compact('row','column','value'));
                }),
            Column::make("Rut", "Rut")
                ->sortable()->searchable(),
            Column::make('Nombre','Nombres')
                ->format(function ($value, $column, $row) {
                    return $column->Nombres. " ".$column->Apellidos;
                }),
            Column::make("Nombres", "Nombres")
                ->sortable()->searchable()->hideIf(1==1),
            Column::make('Apellidos','Apellidos')
                ->searchable()->sortable()->hideIf(1==1),
            Column::make('Patente','Patente')
                ->searchable()->sortable(),
            Column::make("Ingreso", "FechaCreacion")
                ->sortable()
                ->format( fn ( $value ) =>
                    Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "H:i")
                )
        ];
    }

    /*public function filters(): array
    {
        return [

            TextFilter::make('Rut', 'Rut')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar RUT',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('MA_Visitas.Rut', 'like', '%'.$value.'%');
                }),
            TextFilter::make('Email', 'Email')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Email',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('MA_Visitas.Email', 'like', '%'.$value.'%');
                }),
        ];
    }*/
}
