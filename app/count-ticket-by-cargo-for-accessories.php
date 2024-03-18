<?php

use App\Models\AccessoryTicket\AccessoryTicket;
use Illuminate\Database\Eloquent\Builder;

function countTicketAccessory(): Builder
{
    $profiles = ticketByCargo( auth()->user()->ID );

    $ids = array();

    foreach ($profiles as $profile) {
        $ids[] = $profile->ID;
    }

    if (empty($ids)) {
        return AccessoryTicket::query()
            ->leftJoin('MA_Usuarios as Recorder', 'TKa_tickets.applicant', '=', 'Recorder.ID')
            ->leftJoin('MA_Usuarios as Responsible', 'TKa_tickets.assigned', '=', 'Responsible.ID')
            ->select('TKa_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
            ->where( 'TKa_tickets.applicant', auth()->user()->ID )
            ->orWhere( 'TKa_tickets.assigned', auth()->user()->ID );
    }

    return AccessoryTicket::query()
        ->leftJoin('MA_Usuarios as Recorder', 'TKa_tickets.applicant', '=', 'Recorder.ID')
        ->leftJoin('MA_Usuarios as Responsible', 'TKa_tickets.assigned', '=', 'Responsible.ID')
        ->select('TKa_tickets.*', 'Recorder.Nombre as solicitante', 'Responsible.Nombre as asignado')
        ->where( 'TKa_tickets.applicant', auth()->user()->ID )
        ->orWhere( 'TKa_tickets.assigned', auth()->user()->ID )
        ->orWhereIn( 'TKa_tickets.applicant', $ids )
        ->orWhereIn( 'TKa_tickets.assigned', $ids );
}
