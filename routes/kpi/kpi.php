<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Kpi\KpiController;

Route::prefix('kpi')->group(function() {
    Route::get('/', [KpiController::class, 'index'])->name('kpi');

    Route::prefix('reporte')->group(function() {
        //Route::get('/etapas/', [DypController::class, 'reporte_tiempos'])->name('reportetiempos');
    });
});
