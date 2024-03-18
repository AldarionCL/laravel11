<?php

use App\Http\Controllers\OperationController;
use App\Http\Livewire\Operation\OperationDetailTicket;
use App\Http\Livewire\Operation\OperationTicketConfig;
use App\Http\Livewire\Operation\ReportOperation;

Route::get('/operaciones', [ OperationController::class, 'index' ] )->name('operation')/*->middleware('permission:Crear Ticket Call Center')*/;
Route::get('/operaciones-ticket-config', OperationTicketConfig::class)->name('operation.config')/*->middleware('permission:Configuracion Ticket Call Center')*/;
Route::get('/operaciones-detail-ticket/{ticket}', OperationDetailTicket::class )->name('operation.ticket.show')/*->middleware('permission:Editar Ticket Call Center')*/;

Route::get( '/reportes-operaciones', ReportOperation::class)->name('report.operation');
