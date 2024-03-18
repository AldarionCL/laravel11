<?php

use App\Http\Livewire\Cash\DetailCash;
use App\Http\Livewire\Cash\FormCash;
use App\Http\Livewire\Cash\ListCashRegister;

Route::get('formulario-caja-chica', FormCash::class)->name('cash.form')/*->middleware('permission:Crear rendición de Caja')*/;
Route::get('listado-registros-caja-chica', ListCashRegister::class)->name('cash.list')/*->middleware('permission:Editar rendición de Caja')*/;
Route::get('detalle-caja-chica/{cash}', DetailCash::class)->name('cash.detail')/*->middleware('permission:Editar rendición de Caja')*/;
