<?php

use App\Exports\CashExport;
use App\Exports\TiInventoryExport;
use App\Http\Livewire\Ti\FormTiInventory;
use App\Http\Livewire\Ti\FormTiProduct;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/creacion-articulos-ti', FormTiProduct::class)->name('form.articles.ti');
Route::get('/registro-inventario-ti', FormTiInventory::class)->name('form.inventory.ti');

Route::get('/inventario-ti', function (){
    return Excel::download(new TiInventoryExport(), 'inventario-ti.xlsx');
})->name('inventory.ti');
