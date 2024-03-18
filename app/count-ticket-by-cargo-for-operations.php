<?php

use App\Models\OperationTicket\OperationTicket;
use Illuminate\Database\Eloquent\Builder;

function countTicketOperation(): Builder
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
        ->where( 'TKo_tickets.applicant', auth()->user()->ID )
        ->orWhere( 'TKo_tickets.assigned', auth()->user()->ID )
        ->orWhereIn( 'TKo_tickets.applicant', $ids )
        ->orWhereIn( 'TKo_tickets.assigned', $ids );
}
