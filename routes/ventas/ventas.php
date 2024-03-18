<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\Ventas\VentasController;
use App\Http\Livewire\Ticket\DetailTicket;
use App\Http\Livewire\Ticket\TicketConfig;

Route::get('/ventas', [ VentasController::class,  'index' ] )->name('ventas');
