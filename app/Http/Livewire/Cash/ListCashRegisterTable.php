<?php

namespace App\Http\Livewire\Cash;

use App\Http\Utils\Workplace;
use App\Models\Cash\Cash;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ListCashRegisterTable extends DataTableComponent
{
    public string $filterLayout = 'slide-down';

    public bool $status;

    public ?int $searchFilterDebounce = 500;

    protected Workplace $workplace;
    public array $branches;

    public function __construct($id = null)
    {
        $this->workplace = new Workplace();
        $this->branches = $this->branchOffices();
    }

    public function mount(): void
    {
        if (session()->has('pendingCash')) {
            $this->status = session('pendingCash' );
        }else{
            $this->status = false;
        }
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['RC_cashes.id as id'])
            ->setDefaultSort('RC_cashes.id', 'desc')
            ->setConfigurableAreas([
                'toolbar-right-start' => [
                    'cash.datatable.filter', [
                        'status' => $this->status,
                    ]
                ]
            ]);
    }

    public function builder(): Builder
    {
        if ($this->status === false) {
            if (auth()->user()->ID === 1284 ){
             return Cash::query()->whereHas('cashierApprovals');
            }else {
                return Cash::query()->whereHas('cashierApprovals', function (Builder $query) {
                    $query->where('cashier_approver_id', auth()->user()->ID);
                })->orWhere('user_id', auth()->user()->ID);
            }
        }elseif($this->status){
            if (auth()->user()->ID === 1284 ){
                return Cash::query()->whereHas('cashierApprovals');
            }else {
                return Cash::query()->whereHas('cashierApprovals', function (Builder $query) {
                    $query->where('cashier_approver_id', auth()->user()->ID)->where('state', 1);
                });
            }
        }
    }

    public function updatedStatus(): void
    {
        if (!session()->has('pendingCash')) {
            session()->put('pendingCash', true);
        }else{
            session()->put('pendingCash', $this->status);
        }
        $this->emit('refreshDatatable');
    }

    public function columns(): array
    {
        return [

            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('cash.datatable.route')->with('id', $value)
                )
                ->html(),
            LinkColumn::make('ID', 'id')
                ->searchable()
                ->secondaryHeaderFilter('id')
                ->title(fn($row) => $row->id)
                ->location(fn($row) => route('cash.detail', $row->id)),
            Column::make("Rendido por:", "user.Nombre")
                ->searchable()
                ->sortable(),
            Column::make('Aprobador', 'id')
//                ->secondaryHeaderFilter('approver')
                ->searchable()
                ->format(
                    fn($value, $row, Column $column) => view('cash.datatable.approvals')->with('id', $value)
                )
                ->sortable(),
            Column::make("Gerencia", "branch_office.brand.Gerencia")
                ->searchable()
                ->sortable(),
            Column::make("Sucursal", "branch_office.Sucursal")
                ->searchable()
                ->sortable(),
            Column::make("Total", "id")
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    $cash = Cash::find($value);
                    return "<span class='badge badge-danger'>" . number_format( $cash->cashDetails->where('state', 1)->sum('total') , 0, '', '.'). "</span>";
/*                    return "<span class='badge badge-danger'>" . number_format( $value , 0, '', '.') . "</span>";*/
                })
                ->html()
                ->sortable(),
            Column::make("Estado", "status")
                ->format(function ($value, $row, Column $column) {
                    if ($value == 1) {
                        return '<span class="badge badge-success">Pendiente de Aprobación</span>';
                    } elseif ($value == 2) {
                        return '<span class="badge badge-warning">Aprobado</span>';
                    } elseif ($value == 3) {
                        return '<span class="badge badge-danger">Rechazado</span>';
                    }
                })
                ->html()
                ->sortable(),
            Column::make("Ingresado", "created_at")
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('ID', 'id')
                ->config([
                    'placeholder' => 'Buscar ID',
                    'maxlength' => '25',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('RC_cashes.id' ,$value);
                }),
            SelectFilter::make('Gerencia')
                ->options(
                    $this->managements()
                )
                ->filter(function (Builder $builder, string $value) {
                    $this->selectManagements($builder, $value);
                }),
            SelectFilter::make('Sucursal', 'branch')
                ->options([
                        '' => 'Todos',
                    ] + $this->branches )
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('RC_cashes.branch_office_id', $value);
                }),
            SelectFilter::make('Estado')
                ->options([
                    '' => 'Todos',
                    '1' => 'Pendiente de aprobación',
                    '2' => 'Aprobado',
                    '3' => 'Rechazado',
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    if ( $value === '1' ) {
                        $builder->where('status', 1 );
                    } elseif ( $value === '2' ) {
                        $builder->where('status', 2 );
                    } elseif ( $value === '3' ) {
                        $builder->where('status', 3 );
                    }
                }),
            DateFilter::make('Desde')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('RC_cashes.created_at', '>=', $value.' 00:00:01');
                }),
            DateFilter::make('Hasta')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('RC_cashes.created_at', '<=', $value.' 23:59:59');
                }),
//            SelectFilter::make('Aprobador', 'approver')
//                ->hiddenFromMenus()
//                ->hiddenFromFilterCount()
//                ->options([
//                    '' => 'Todos',
//                ] + $this->approver())
//                ->filter(function(Builder $builder, string $value) {
//                    $builder->where('ALEXIS_cashes.approver_id', $value);
//                }),
        ];
    }

    public function branchOffices(): array
    {
        return Cash::query()
            ->select('MA_Sucursales.Sucursal', 'MA_Sucursales.ID')
            ->join('MA_Sucursales', 'MA_Sucursales.ID', '=', 'RC_cashes.branch_office_id')
            ->orderBy('MA_Sucursales.Sucursal', 'ASC')
            ->distinct()
            ->pluck('MA_Sucursales.Sucursal', 'MA_Sucursales.ID')
            ->toArray();
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

    public function selectManagements($builder, $value)
    {
        return $value !== '0' ? $builder->where('MA_Gerencias.ID', '=', $value) : $builder->where('MA_Gerencias.ID', '>', 0);
    }

//    private function approver(): array
//    {
//        return Cash::query()
//            ->select('MA_Usuarios.Nombre', 'MA_Usuarios.ID', 'RC_cashes.id', 'RC_cashes.user_id')
//            ->join('MA_Usuarios', 'MA_Usuarios.ID', '=', 'RC_cashes.approver_id')
//            ->orderBy('MA_Usuarios.Nombre', 'ASC')
//            ->distinct()
//            ->pluck('MA_Usuarios.Nombre', 'MA_Usuarios.ID')
//            ->toArray();
//    }

    public function updatedTableFiltersGerencia( $value ): void
    {
        $this->branches = branchOfficesFilter( $value );
        $this->filters();
        $this->emit('refreshFilters');
    }
}
