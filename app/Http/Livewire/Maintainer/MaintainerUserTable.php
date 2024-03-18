<?php

namespace App\Http\Livewire\Maintainer;

use App\Exports\UserExport;
use App\Http\Utils\Workplace;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class MaintainerUserTable extends DataTableComponent
{
    protected $model = User::class;

    public ?int $searchFilterDebounce = 500;

    public string $filterLayout = 'slide-down';

//    protected Workplace $workplace;
    public array $branches;

    public function __construct($id = null)
    {
//        $this->workplace = new Workplace();
//        $this->branches = $this->branchOffices();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['MA_Usuarios.ID as id']);
    }

    public function columns(): array
    {
        return [
            LinkColumn::make('ID', 'id')
                ->title(fn($row) => $row->id)
                ->location(fn($row) => route('maintainer.users.detail', $row->id)),
            Column::make('Asignación', 'id')
                ->format(
                    fn($value, $row, Column $column) => '<a href='. route('maintainer.branch.for.user', $value ).'><i class="fa fa-search" aria-hidden="true"></i></a>'
                )
                ->html(),
            Column::make("Nombre", "Nombre")
                ->searchable()
                ->sortable(),
            Column::make("Email", "Email")
                ->searchable()
                ->sortable(),
            Column::make("Telefono Oficina", "TelefonoOficina")
                ->searchable()
                ->sortable(),
            Column::make("Celular", "Celular")
                ->searchable()
                ->sortable(),
            Column::make("Perfil", "profile.Perfil")
                ->searchable()
                ->sortable(),
            Column::make("Cargo", "position.Cargo")
                ->searchable()
                ->sortable(),
            BooleanColumn::make('Disponible'),
            BooleanColumn::make('Activo')
        ];
    }

    public array $bulkActions = [
        'changeActive' => 'Activar',
        'changeDeactivate' => 'Desactivar',
        'changeAvailable' => 'Disponible',
        'changeUnavailable' => 'No Disponible',
        'exportSelection' => 'Exportar',
    ];

    public function exportSelection() {
        if ($this->getSelectedCount() > 0) {
            $register = $this->getSelected();
            return Excel::download(new UserExport($register ), 'usuarios.xlsx');
        }
    }

    public function changeActive(): void
    {
        foreach ( $this->getSelected() as $item){
            User::where('id', $item)->update(['Activo' => 1]);
        }

        $this->clearSelected();
    }

    public function changeDeactivate(): void
    {
        foreach ( $this->getSelected() as $item){
            User::where('id', $item)->update(['Activo' => 0]);
        }

        $this->clearSelected();
    }
    public function changeAvailable(): void
    {
        foreach ( $this->getSelected() as $item){
            User::where('id', $item)->update(['Disponible' => 1]);
        }

        $this->clearSelected();
    }

    public function changeUnavailable(): void
    {
        foreach ( $this->getSelected() as $item){
            User::where('id', $item)->update(['Disponible' => 0]);
        }

        $this->clearSelected();
    }

//    public function filters(): array
//    {
//        return [
//            SelectFilter::make('Gerencia')
//                ->options(
//                    $this->managements()
//                )
//                ->filter(function(Builder $builder, string $value) {
//                    $this->selectManagements($builder, $value);
//                }),
//            SelectFilter::make('Sucursal')
//                ->options(
//                    $this->branches
//                )
//                ->filter(function(Builder $builder, string $value) {
//                    $this->selectBranches($builder, $value);
//                })
//        ];
//    }

//    public function managements(): array
//    {
//        $gerencia = $this->workplace->brands();
//
//        $managements = array();
//        $managements[0] = "Todos";
//
//        foreach ($gerencia as $management) {
//            $managements[$management->ID] = $management->Gerencia;
//        }
//
//        return $managements;
//    }
//
//    public function branchOffices(): array
//    {
//        $branches = array();
//
//        $location = User::location()->get();
//
//        $branches[0] = "Todos";
//
//        foreach ($location[0]['sucursales'] as $items)
//        {
//            $branches[$items->ID] = $items->Sucursal;
//        }
//
//        return $branches;
//
//    }
//
//    public function selectManagements( $builder, $value )
//    {
//        return $value !== '0' ? $builder->where( 'MA_Gerencias.ID', '=',  $value) : $builder->where( 'MA_Gerencias.ID', '>', 0);
//    }
//
//    public function selectBranches( $builder, $value )
//    {
//        return $value !== '0' ? $builder->where( 'MA_Sucursales.ID', '=',  $value) : $builder->where( 'MA_Sucursales.ID', '>', 0);
//    }
//
//    public function updatedTableFiltersGerencia( $value ): void
//    {
//        $this->branches = branchOfficesFilter( $value );
//        $this->filters();
//        $this->emit('refreshFilters');
//    }
}
