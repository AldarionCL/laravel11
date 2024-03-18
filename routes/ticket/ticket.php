<?php

use App\Http\Controllers\TicketController;
use App\Http\Livewire\Ticket\DetailTicket;
use App\Http\Livewire\Ticket\TicketConfig;

Route::get('/ticket', [ TicketController::class,  'index' ] )->name('/ticket')/*->middleware('permission:Crear Ticket')*/;

Route::get('/detail-ticket/{ticket}', DetailTicket::class )->name('ticket.show')/*->middleware('permission:Editar Ticket')*/;
Route::get('/ticket-config', TicketConfig::class)->name('ticket.config')/*->middleware('permission:Configuracion Ticket')*/;
