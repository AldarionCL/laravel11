<?php

use Illuminate\Support\Facades\DB;

function saveNotification(int $idUser, string $cookie, string $ip, int $id, int $idNotification, string $message, int $menuId, int $event): void
{
    DB::select(
        "CALL SIS_NotificacionesGuardar( ?, ?, ?, ?, ?, ?, ?, ? )",
        array($idUser, $cookie, $ip, $id, $idNotification, $message, $menuId, $event)
    );
}

function ticketByCargo($id): array
{
    return $profiles = DB::select(
        'CALL HD_AgenteTicket(?)',
        array($id)
    );
}

function wsLandbotLeadsModelo( $branch, $modelo, $client, $rut, $name, $phone, $mail, $chat_id ): array
{
    return $seller = DB::select(
        "CALL WS_LandbotLeadsModelo( ?, ?, ?, ?, ?, ?, ?, ? ) ",
        array( $branch, $modelo, $client, $rut, $name, $phone, $mail, $chat_id )
    );
}
