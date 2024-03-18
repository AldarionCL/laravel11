<?php

namespace App\Http\Livewire\Operation;

use App\Exports\TicketsExport;
use App\Http\Utils\Workplace;
use App\Models\OperationTicket\OperationTicket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class OperationTicketTable extends DataTableComponent
{
    public string $filterLayout = 'slide-down';
    // protected Workplace $workplace;
    public $management;

    public function getWorkplaceProperty(): Workplace
    {
        return new Workplace();
    }
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('operation.ticket.show', $row);
            })
            ->setDefaultSort('ID', 'desc');
        $this->setPaginationVisibilityEnabled();
    }

    public function builder(): Builder
    {
        $profiles = ticketByCargo( auth()->user()->ID );

        $ids = array();

        foreach ($profiles as $profile) {
            $ids[] = $profile->ID;
        }

        if (empty($ids)) {
            return OperationTicket::query()
                ->leftJoin('MA_Usuarios as Recorder', 'TKo_tickets.applicant', '=', 'Recorder.ID')
                ->leftJoin('MA_Usuarios as Responsible', 'TKo_tickets.assigned', '=', 'Responsible.ID')
                ->select('TKo_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
                ->where( 'TKo_tickets.applicant', auth()->user()->ID )
                ->orWhere( 'TKo_tickets.assigned', auth()->user()->ID );
        }

        return OperationTicket::query()
            ->leftJoin('MA_Usuarios as Recorder', 'TKo_tickets.applicant', '=', 'Recorder.ID')
            ->leftJoin('MA_Usuarios as Responsible', 'TKo_tickets.assigned', '=', 'Responsible.ID')
            ->select('TKo_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
            ->where( function ( $query ) use ( $ids ) {
                $query->whereIn('TKo_tickets.applicant', $ids)->orWhereIn('TKo_tickets.assigned', $ids);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->secondaryHeaderFilter('id')
                ->sortable(),
            Column::make("Asunto", "title")
                ->secondaryHeaderFilter('subjet')
                ->searchable()
                ->sortable(),
            Column::make("Asignado")
                ->secondaryHeaderFilter('responsible')
                ->label( fn ($row) => $row->asignado)
                ->searchable()
                ->sortable(),
            Column::make("Creado")
                ->secondaryHeaderFilter('recorder')
                ->label( fn ($row) => $row->solicitante)
                ->searchable()
                ->sortable(),
            Column::make("Gerencia", "gerencia.Gerencia")
                ->secondaryHeaderFilter('management')
                ->searchable()
                ->sortable(),
            Column::make("Sucursal", "office.Sucursal")
                ->secondaryHeaderFilter('branch')
                ->searchable()
                ->sortable(),
            Column::make("Prioridad", "priority")
                ->searchable()
                ->sortable(),
            Column::make("Categoria", "subCategory.name")
                ->secondaryHeaderFilter('subCategory')
                ->searchable()
                ->sortable(),
            Column::make("Estado", "state")
                ->searchable()
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => view('ticket.datatable.state')->withTicket($value)
                ),
            Column::make("Ingresado", "created_at")
                ->sortable()
                ->format( function ( $value ) {
                    return Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y");
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
                ->view('ticket.datatable.close')
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Estado', 'state')
                ->options([
                    '' => 'Todos',
                    '1' => 'Abierto',
                    '2' => 'Proceso',
                    '3' => 'Cerrado',
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('state', 1);
                    } elseif ($value === '2') {
                        $builder->where('state', 2);
                    }elseif ($value === '3') {
                        $builder->where('state', 3);
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
                    $builder->where( 'TKo_tickets.id', 'like', "%$value%");
                }),
            TextFilter::make('Asunto', 'subjet')
                ->hiddenFromMenus()
                ->hiddenFromFilterCount()
                ->config([
                    'placeholder' => 'Buscar Asunto',
                    'maxlength' => 25
                ])
                ->filter( function ( Builder $builder, string $value ) {
                    $builder->where( 'TKo_tickets.title', 'like', "%$value%");
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
                    $builder->where( 'TKo_sub_categories.name', 'like', "%$value%");
                })

        ];
    }

    public array $bulkActions = [
        'exportSelection' => 'Exportar',
    ];

    public function exportSelection() {
        if ($this->getSelectedCount() > 0) {
            $tickets = $this->getSelected();
            return Excel::download(new TicketsExport($tickets, "operation" ), 'tickets.xlsx');
        }
    }
}
