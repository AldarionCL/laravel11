<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Livewire\Accessory\AccessoryDetailTicket;
use App\Http\Livewire\Accessory\AccessoryTicketConfig;
use App\Http\Livewire\Accessory\ReportAccessory;

Route::get('/accesorios', [ AccessoryController::class, 'index' ] )->name('accessory')/*->middleware('permission:Crear Ticket Accesorios')*/;
Route::get('/accesorios-ticket-config', AccessoryTicketConfig::class)->name('accessory.config')/*->middleware('permission:Configuracion Ticket Accesorios')*/;
Route::get('/accesorios-detail-ticket/{ticket}', AccessoryDetailTicket::class )->name('accessory.ticket.show')/*->middleware('permission:Editar Ticket Accesorios')*/;

Route::get( '/reportes-accesorios', ReportAccessory::class)->name('report.accessory');
