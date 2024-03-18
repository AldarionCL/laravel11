<?php

namespace App\Http\Livewire\Ticket;

use App\Exports\TicketsExport;
use App\Http\Utils\TicketByCargo;
use App\Http\Utils\Workplace;
use App\Models\Ticket\Agent;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class TicketTable extends DataTableComponent
{
    private TicketByCargo $ticketByCargo;

    public string $filterLayout = 'slide-down';
    protected Workplace $workplace;

    public $branches;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->ticketByCargo = new TicketByCargo();
        $this->workplace = new Workplace();
        $this->branches = $this->branchOffices();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('ID', 'desc')
            ->setPaginationVisibilityEnabled()
            ->setTdAttributes( function (Column $column){
                return [
                  'class' => 'text-xs'
                ];
            });
    }

    public function builder(): Builder
    {
        $profiles = ticketByCargo( auth()->user()->ID );

        $ids = array();

        foreach ($profiles as $profile) {
            $ids[] = $profile->ID;
        }

        if (empty($ids)) {
            return Ticket::query()
                ->leftJoin('MA_Usuarios as Recorder', 'TK_tickets.applicant', '=', 'Recorder.ID')
                ->leftJoin('MA_Usuarios as Responsible', 'TK_tickets.assigned', '=', 'Responsible.ID')
                ->select('TK_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
                ->where( 'TK_tickets.applicant', auth()->user()->ID )
                ->orWhere( 'TK_tickets.assigned', auth()->user()->ID );
        }

        return Ticket::query()
            ->leftJoin('MA_Usuarios as Recorder', 'TK_tickets.applicant', '=', 'Recorder.ID')
            ->leftJoin('MA_Usuarios as Responsible', 'TK_tickets.assigned', '=', 'Responsible.ID')
            ->select('TK_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
            ->where( function ( $query ) use ( $ids ) {
                $query->whereIn('TK_tickets.applicant', $ids)->orWhereIn('TK_tickets.assigned', $ids);
            });
    }

    public function agents(): array
    {
        $data = Agent::with('user:ID,Nombre')->select('user_id')->get();

        $agents = array();

        $agents[0] = "Todos";

        foreach ($data as $item) {
            $agents[$item->user->ID] = strtoupper( $item->user->Nombre );
        }

        return $agents;
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

    public function branchOffices(): array
    {
        $branches = array();

        $location = User::location()->get();

        $branches[0] = "Todos";

        foreach ($location[0]['sucursales'] as $items)
        {
            $branches[$items->ID] = $items->Sucursal;
        }

        return $branches;

    }



    public function columns(): array
    {
        return [
            Column::make('Acción', 'id')
                ->format( fn ($value, $row, Column $column) => view('ticket.datatable.route')->with('id', $value)
                )
                ->html(),
            Column::make("ID", "id")
                ->searchable()
                ->sortable(),
            Column::make("Asunto", "title")
                ->searchable()
                ->sortable(),
            Column::make("Estado", "state")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => view('ticket.datatable.state')->withTicket($value)
                ),
            Column::make("Asignado")
                ->label( fn ($row) => $row->asignado )
                ->searchable()
                ->sortable(),
            Column::make("Creado")
                ->label( fn ($row) => $row->solicitante )
                ->searchable()
                ->sortable(),
            Column::make("Gerencia", "gerencia.Gerencia")
                ->searchable()
                ->sortable(),
            Column::make("Sucursal", "office.Sucursal")
                ->searchable()
                ->sortable(),
            Column::make("Prioridad", "priority")
                ->searchable()
                ->sortable(),
            Column::make("Categoria", "subCategory.name")
                ->searchable()
                ->sortable(),
            Column::make("Ingresado", "created_at")
                ->sortable()
                ->format( function ( $value ) {
                    return Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y H:i");
                } ),
            Column::make("Actualizado", "state")
                ->searchable()
                ->sortable()
                ->view('ticket.datatable.update'),
            Column::make("Tiempo de Respuesta", "state")
                ->searchable()
                ->sortable()
                ->view('ticket.datatable.response'),
            Column::make("Tiempo de Cierre", "state")
                ->searchable()
                ->sortable()
                ->view('ticket.datatable.close'),
             Column::make("Tiempo de SLA", "subCategory.SLA")
                 ->searchable()
                 ->sortable()
                 ->format( function ( $value , $record ) {
                     $tiempoSLA = Carbon::createFromFormat("Y-m-d H:i:s",$record->created_at)->addHours( $value );
                     // retorna diferencia de fecha de ahora con $tiempoSla
                        return $tiempoSLA->diffForHumans(Carbon::now(), true, true, 2, Carbon::DIFF_RELATIVE_TO_NOW);

                 } ),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Gerencia', 'brands')
                ->options(
                    $this->managements()
                )
                ->filter(function(Builder $builder, string $value) {
                $this->selectManagements($builder, $value);
            }),
            SelectFilter::make('Sucursal')
                ->options(
                    $this->branches
                )
                ->filter(function(Builder $builder, string $value) {
                $this->selectBranches($builder, $value);
            }),
            SelectFilter::make('Agente')
                ->options(
                    $this->agents()
                )
                ->filter(function(Builder $builder, string $value) {
                    $this->selectAgents($builder, $value);
                }),
            SelectFilter::make('Estado', 'estado')
                ->options([
                    '' => 'Todos',
                    '1' => 'Abierto',
                    '2' => 'Proceso',
                    '3' => 'Cerrado',

                ])
                ->filter( function ( Builder $builder, string $value ) {
                    if ( $value === '1' ) {
                        $builder->where('state', 1 );
                    } elseif ( $value === '2' ) {
                        $builder->where('state', 2 );
                    }elseif ( $value === '3' ) {
                        $builder->where('state', 3 );
                    }
                }),
            TextFilter::make('ID', 'id')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar N°',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'TK_tickets.id', 'like', "%$value%");
                }),
            TextFilter::make('Asunto', 'subjet')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Asunto',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'TK_tickets.title', 'like', "%$value%");
                }),
            TextFilter::make('Asignado', 'responsible')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Agente',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'Responsible.Nombre', 'like', "%$value%");
                }),
            TextFilter::make('Creado', 'recorder')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Creador',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'Recorder.Nombre', 'like', "%$value%");
                }),
            TextFilter::make('Gerencia', 'manegment')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Gerencia',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Gerencias.Gerencia', 'like', "%$value%");
                }),
            TextFilter::make('Sucursal', 'branch')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Sucursal',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'MA_Sucursales.Sucursal', 'like', "%$value%");
                }),
            TextFilter::make('Categoria', 'subCategory')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Categoria',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'TK_sub_categories.name', 'like', "%$value%");
                }),
            DateFilter::make('Desde')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('TK_tickets.created_at', '>=', $value.' 00:00:01' );
                }),
            DateFilter::make('Hasta')
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('TK_tickets.created_at', '<=', $value.' 23:59:59');
                }),
        ];
    }

    public function selectAgents( $builder, $value )
    {
        return $builder->where( 'assigned', '=',  $value);
    }

    public function selectManagements( $builder, $value )
    {
        return $builder->where( 'management', '=',  $value);
    }

    public function selectBranches( $builder, $value )
    {
        return $builder->where( 'department', '=',  $value);
    }

    public array $bulkActions = [
        'exportSelection' => 'Exportar',
    ];

    public function exportSelection() {
        if ($this->getSelectedCount() > 0) {
            $tickets = $this->getSelected();
            return Excel::download(new TicketsExport($tickets, "ticket" ), 'tickets.xlsx');
        }
    }

    public function updatedTableFiltersBrands( $value ): void
    {
        $this->branches = branchOfficesFilter($value);
        $this->filters();
        $this->emit('refreshFilters');
    }
}
