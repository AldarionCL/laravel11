<?php

use App\Http\Controllers\CallCenterController;
use App\Http\Livewire\CallCenter\CallCenterDetailTicket;
use App\Http\Livewire\CallCenter\CallCenterTicketConfig;
use App\Http\Livewire\CallCenter\ReportCallCenter;

Route::get('/call-center', [ CallCenterController::class, 'index' ] )->name('call.center')/*->middleware('permission:Crear Ticket Call Center')*/;
Route::get('/call-center-ticket-config', CallCenterTicketConfig::class)->name('call.center.config')/*->middleware('permission:Configuracion Ticket Call Center')*/;
Route::get('/call-center-detail-ticket/{ticket}', CallCenterDetailTicket::class )->name('call.center.ticket.show')/*->middleware('permission:Editar Ticket Call Center')*/;

Route::get( '/reportes-call-center', ReportCallCenter::class)->name('report.call.center');
