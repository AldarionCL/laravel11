<?php

use App\Http\Controllers\Cpd\CpdController;
use App\Http\Controllers\Cpd\FlujoCpdController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('cpd/estadocpd/{id}', [FlujoCpdController::class, 'estado_cpd'])->name('estadocpd');
Route::get('/', [ LoginController::class, 'authenticated']);
Route::any('api/creacpdventas', [CpdController::class, 'crea_cpd_ventas'])->name('creaCpdVentas');
Route::any('api/listoretirocpd', [CpdController::class, 'listo_retiro'])->name('listoRetiroCPD');



Route::middleware(['auth'])->group(function () {

Route::get('/test', \App\Http\Livewire\Test::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    require __DIR__ . '/accesory/accesory.php';
    require __DIR__ . '/callcenter/callcenter.php';
    require __DIR__ . '/cash/cash.php';
    require __DIR__ . '/landbot/landbot.php';
    require __DIR__ . '/maintainer/maintainer.php';
    require __DIR__ . '/operation/operation.php';
    require __DIR__ . '/purchaseorder/purchaseorder.php';
    require __DIR__ . '/requestpurchase/requestpurchase.php';
    require __DIR__ .'/ti/ti.php';
    require __DIR__ .'/ticket/ticket.php';
    require __DIR__ .'/customer/customer.php';
    require __DIR__ . '/reception/reception.php';
    require __DIR__ . '/dyp/dyp.php';
    require __DIR__ . '/cpd/cpd.php';
    require __DIR__ . '/kpi/kpi.php';
    require __DIR__ . '/tdrive/tdrive.php';
    require __DIR__ . '/ventas/ventas.php';

    require __DIR__. '/auth.php';

    Route::get('/import', \App\Http\Livewire\Import\ImportData::class)->name('import');
});

Auth::routes();
