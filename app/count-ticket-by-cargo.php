<?php

use App\Models\CallCenterTicket\CallCenterTicket;
use Illuminate\Database\Eloquent\Builder;

function countTicketCallCenter(): Builder
{
    $profiles = ticketByCargo( auth()->user()->ID );

    $ids = array();

    foreach ($profiles as $profile) {
        $ids[] = $profile->ID;
    }

    if (empty($ids)) {
        return CallCenterTicket::query()
            ->leftJoin('MA_Usuarios as Recorder', 'TKc_tickets.applicant', '=', 'Recorder.ID')
            ->leftJoin('MA_Usuarios as Responsible', 'TKc_tickets.assigned', '=', 'Responsible.ID')
            ->select('TKc_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
            ->where( 'TKc_tickets.applicant', auth()->user()->ID )
            ->orWhere( 'TKc_tickets.assigned', auth()->user()->ID );
    }

    return CallCenterTicket::query()
        ->leftJoin('MA_Usuarios as Recorder', 'TKc_tickets.applicant', '=', 'Recorder.ID')
        ->leftJoin('MA_Usuarios as Responsible', 'TKc_tickets.assigned', '=', 'Responsible.ID')
        ->select('TKc_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
        ->where( 'TKc_tickets.applicant', auth()->user()->ID )
        ->orWhere( 'TKc_tickets.assigned', auth()->user()->ID )
        ->orWhereIn( 'TKc_tickets.applicant', $ids )
        ->orWhereIn( 'TKc_tickets.assigned', $ids );
}
