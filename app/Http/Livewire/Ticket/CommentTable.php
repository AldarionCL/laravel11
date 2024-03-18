<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CommentTable extends DataTableComponent
{
    //protected $model = Comment::class;
    public $ticket_id;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('ID', 'desc');
    }

    public function builder(): Builder
    {
        return Comment::query()
            ->with('file', 'recorder')
            ->where('ticket_id', '=', $this->ticket_id);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Comentario", "detail")
                ->searchable()
                ->sortable(),
            Column::make("Ticket id", "ticket_id")
                ->sortable(),
            Column::make("Seguimiento por", "recorder.Nombre")
                ->searchable()
                ->sortable(),
            Column::make("Adjunto", "file.url")
                ->format(
                    fn($value, $row, Column $column) => view('ticket.datatable.adjunto')->withTicket($value)
                ),
            Column::make("Fecha de Ingreso", "created_at")
                ->sortable()
                ->format( function ( $value ) {
                    return Carbon::createFromFormat( "Y-m-d H:i:s", $value)->format( "d-m-Y");
                } ),
        ];
    }
}
