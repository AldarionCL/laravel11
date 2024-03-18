<?php

namespace App\Http\Utils;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Builder;

class TicketByCargo
{

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
            ->where( 'TK_tickets.applicant', auth()->user()->ID )
            ->orWhere( 'TK_tickets.assigned', auth()->user()->ID )
            ->orWhereIn( 'TK_tickets.applicant', $ids )
            ->orWhereIn( 'TK_tickets.assigned', $ids );
    }
}
